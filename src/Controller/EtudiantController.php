<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Etudiant;
use App\Entity\Semestre;
use App\Entity\TypeCours;
use App\Repository\BulletinRepository;
use App\Repository\EtudiantRepository;
use App\Repository\SemestreRepository;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    
    /**
     * @Route("/etudiant/infos", name="etudiant_informationsPerso")
     */
    public function infoPerso( UrlGeneratorInterface $urlGenerator){
        //en attendant la gestion des roles
        if(!$this->getUser()){
            return new RedirectResponse($urlGenerator->generate('app_login'));
        }
       
        return $this->render("etudiant/infoPerso.html.twig", [
            "user" => $this->getUser()
            
        ]);
    }

    /**
     * @Route("/etudiant/bulletin", name="etudiant_bulletin")
     */
    public function bulletin( UrlGeneratorInterface $urlGenerator){
        //en attendant la gestion des roles
        if(!$this->getUser()){
            return new RedirectResponse($urlGenerator->generate('app_login'));
        }
       
        return $this->render("etudiant/bulletin.html.twig", [
            "user" => $this->getUser(),
        ]);
        }
     /**
      *  @Route("/etudiant/{username}/bulletin/semestre{numSemestre}", name="etudiant_voirBulletin")
     *
     * @return void
     */
    public function voirBulletin(BulletinRepository $bulletin,  SemestreRepository $semestre, EtudiantRepository $etudiant, $numSemestre,$username){
        //Recupere etudiant et le semestre passer en GET
        $etudiant = $etudiant->findOneBy(array("username" => $username));
        $semestre = $semestre->findOneBy(array("numSemestre" => $numSemestre));
        //Recupere le bulletin pour un idEtudiant et un numSemestre donnée en parametre GET
        $bulletin = $bulletin->findOneBy(array("etudiant" =>$etudiant->getId(), "semestre" => $semestre->getId()));
        
        $bulletin->getUes()->initialize();
        $bulletin->getNotes()->initialize();

        //Recupere la liste des Ue correspondant au bulletin
        $UEs =$bulletin->getUes()->getValues();
        $modules = array();
        foreach($UEs as $ue){
            array_push($modules,$ue->getModules()->getValues());
        }

       $typeCours = array();
        foreach($modules as $moduleUE){
            
            foreach($moduleUE as $module){
                //recupere dans un tableau les type cours de chaque module de chaque UE
                
                
                array_push($typeCours,$module->getTypeCours()->getValues());
            }
        } 

        foreach($typeCours as $type){
            foreach($type as $t){
                $t->getNotes()->initialize();
            }
        }
        //recuperer toutes les notes de l'étudiant 

        $notes = $bulletin->getNotes()->getValues();
        $bulletin->getNotes()->initialize();
        
        // tableau indiquant si une note peut etre mise ou pas a l'etudiant pour ce module
        $tab0 =[];
        $mod=[];
        foreach($modules as $moduleUE){
            
            foreach($moduleUE as $module){
                $bool=[];
                $valeur = [false,false,false];
                $cours = ["TPS", "TD", "TP"];
                foreach($module->getTypeCours()->getValues() as $type){
                    if($type->getNomCourt() == "TPS"){
                        $valeur[0] = true;
                    }
                    if($type->getNomCourt() == "TD"){
                        $valeur[1] = true;
                    }
                    if($type->getNomCourt() == "TP"){
                        $valeur[2] = true;
                    }
                    $bool = array_combine($cours,$valeur);
                }
                array_push($tab0, $bool);
                array_push($mod, $module->getNom());
                
            }
        }
        $tab = array_combine($mod,$tab0);
        

        return $this->render("etudiant/bulletin.html.twig", [
            "user" => $etudiant,
            "bulletin" => $bulletin,
            "ues" =>$UEs,
            "modules" => $modules,
            "typeCours" => $typeCours,
            "notes" => $notes,
            "tab" =>$tab,
            
            
        ]);
    }
}
