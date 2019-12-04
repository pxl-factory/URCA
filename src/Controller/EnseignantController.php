<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetType;
use App\Repository\EtudiantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EnseignantController extends AbstractController
{
    /**
     * @Route("/enseignant", name="etudiant_liste")
     */
    public function listeEtudiants(EtudiantRepository $etudiant){
        $etudiant = $etudiant->findAll();
        return $this->render("enseignant/listeEtudiants.html.twig", [
            "etudiants" => $etudiant
        ]);
    }


    /**
     * @Route("/enseignant/{username}/infos", name="enseignant_infoEtudiant")
     */
    public function infoPerso(EtudiantRepository $etudiant, $username){
        
        $etudiant = $etudiant->findOneBy(array("username"=>$username));
        return $this->render("enseignant/infoPersoEtudiant.html.twig", [
            "user" => $etudiant
        ]);
    }

    /**
     * @Route("/enseignant/ajouterProjet", name="enseignant_ajouterProjet")
     */
    public function ajouterProjet(Request $request)
{
    // just setup a fresh $task object (remove the example data)
    $prj = new Projet();

    $form = $this->createForm(ProjetType::class, $prj);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $prj = $form->getData();
        $prj->setEnseignant($this->getUser());
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($prj);
        $entityManager->flush();

        return $this->redirectToRoute('etudiant_liste');
    }

    return $this->render('enseignant/ajouterProjet.html.twig', [
        'form' => $form->createView(),
    ]);
}
}
