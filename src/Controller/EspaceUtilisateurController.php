<?php

namespace App\Controller;

use App\Form\ChangePasswordFormType;
use App\Form\EditProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/espace-utilisateur')]
class EspaceUtilisateurController extends AbstractController
{
    #[Route('/', name: 'espace_utilisateur')]
    public function index(): Response
    {
        return $this->render('espace_utilisateur/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    #[Route('/profil', name: 'users_profil', methods: ['GET'])]
    public function profil(): Response
    {
        return $this->render('espace_utilisateur/profil.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    #[Route('/edition-profil', name: 'users_edit_profil', methods: ['GET', 'POST'])]
    public function editProfile(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Le compte a bien été modifier avec succès!');

            return $this->redirectToRoute('users_profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('espace_utilisateur/edit_profil.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/modifier-votre-mot-de-passe', name: 'users_edit_password', methods: ['GET', 'POST'])]
    public function editPassword(
        Request $request, UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager
    ): Response
    {
        $user = $this->getUser();

        // The token is valid; allow the user to change their password.
        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Encode(hash) the plain password, and set it.
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->flush();

            // The session is cleaned up after the password has been changed.
            //$this->cleanSessionAfterReset();

            $this->addFlash('success', 'Mot de passe modifer avec succès essayer votre nouveau mot de passe');

            return $this->redirectToRoute('app_logout');
        }

        return $this->render('espace_utilisateur/edit_password.html.twig', [
            'resetForm' => $form->createView(),
            'user' => $user
        ]);
    }
}