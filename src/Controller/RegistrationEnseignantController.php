<?php

namespace App\Controller;

use App\Entity\Enseignant;
use App\Security\EtudiantAuthenticator;
use App\Form\RegistrationEnseignantFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationEnseignantController extends AbstractController
{
    /**
     * @Route("/register/enseignant", name="app_registerEnseignant")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, EtudiantAuthenticator $authenticator): Response
    {
        $user = new Enseignant();
        $form = $this->createForm(RegistrationEnseignantFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            )
            ->setRoles(['ROLE_ENSEIGNANT'])
            ;

            $entityManager = $this->getDoctrine()->getManager();
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

        return $this->render('registration/registerEnseignant.html.twig', [
            'registrationEnseignantForm' => $form->createView(),
        ]);
    }
}
