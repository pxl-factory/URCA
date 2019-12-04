<?php

namespace App\Controller;


use App\Repository\UserRepository;
use App\Repository\EtudiantRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UrcaController extends AbstractController
{
    /**
     * @Route("/", name="urca")
     */
    public function home()
    {
        return $this->render('urca/home.html.twig');
    }
    
    

    

    
}

