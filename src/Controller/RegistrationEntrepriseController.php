<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Security\EtudiantAuthenticator;
use App\Form\RegistrationEntrepriseFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationEntrepriseController extends AbstractController
{
    /**
     * @Route("/register/entreprise", name="app_registerEntreprise")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, EtudiantAuthenticator $authenticator): Response
    {
        $user = new Entreprise();
        $form = $this->createForm(RegistrationEntrepriseFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            )
            ->setRoles(['ROLE_ENTREPRISE'])
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

        return $this->render('registration/registerEntreprise.html.twig', [
            'registrationEntrepriseForm' => $form->createView(),
        ]);
    }
}
