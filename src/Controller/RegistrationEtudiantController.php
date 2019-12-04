<?php

namespace App\Controller;

use App\Entity\UE;
use App\Entity\Note;
use App\Entity\Module;
use App\Entity\Bulletin;
use App\Entity\Etudiant;
use App\Entity\Semestre;
use App\Entity\NombreNote;
use App\Repository\UERepository;
use App\Repository\ModuleRepository;
use App\Repository\SemestreRepository;
use App\Security\EtudiantAuthenticator;

use App\Repository\NombreNoteRepository;
use App\Form\RegistrationEtudiantFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationEtudiantController extends AbstractController
{
    /**
     * @Route("/register/etudiant", name="app_registerEtudiant")
     */
    public function register(NombreNoteRepository $nbNote, ModuleRepository $module, UERepository $ue, SemestreRepository $semestre,Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, EtudiantAuthenticator $authenticator): Response
    {
        $user = new Etudiant();
        $form = $this->createForm(RegistrationEtudiantFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            )
            ->setRoles(['ROLE_ETUDIANT']);

            $entityManager = $this->getDoctrine()->getManager();
            /* mise en place des bulletins lors de la création d'un étudiant */

            
            for($i=1;$i<=4;$i++){
                $semestrei = $semestre->findOneBy(array("numSemestre" => $i));
                
                $bulletin = new Bulletin();
                
                $bulletin->setSemestre($semestre->findOneBy(array("numSemestre" => $i)));
                $UES = $ue->findBy(array("semestre" => $semestrei));
                foreach($UES as $unite){
                    $bulletin->addUE($unite);

                    $modules = $unite->getModules();
                    foreach($modules as $matiere){
                        $listeTypeCours = $matiere->getTypeCours();
                        foreach($listeTypeCours as $typecours){
                            $nbNotei = $nbNote->findOneBy(array("typeCours" => $typecours, "module" =>$matiere));
                            for($j= 0;$j<$nbNotei->getNbNote();$j++){

                                if($j == 0){
                                    $note = new Note();
                                    $note->setTypeCours($typecours)
                                    ->setCoeff(100*$nbNotei->getRatio1erNote())
                                    ->setModule($matiere)
                                    ->setBulletin($bulletin);
                                }
                                else if($nbNotei->getNbNote()>1){
                                    $note = new Note();
                                    $note->setTypeCours($typecours)
                                    ->setCoeff(100 * ( (1-$nbNotei->getRatio1erNote()) / ($nbNotei->getNbNote()-1) ) )
                                    ->setModule($matiere)
                                    ->setBulletin($bulletin);
                                }
                                
                                $typecours->addNote($note);
                                $entityManager->persist($note);
                            }
                            
                        }
                    }
                    
                }

                $entityManager->persist($bulletin);
                $user->addBulletin($bulletin);
                
            }
            

            
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/registerEtudiant.html.twig', [
            'registrationEtudiantForm' => $form->createView(),
        ]);
    }
}
