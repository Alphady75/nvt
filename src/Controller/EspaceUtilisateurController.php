<?php

namespace App\Controller;

use App\Form\EditProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/espace-utilisateur')]
class EspaceUtilisateurController extends AbstractController
{
    #[Route('/', name: 'espace_utilisateur')]
    public function index(): Response
    {
        return $this->render('espace_utilisateur/index.html.twig', [
            'controller_name' => 'EspaceUtilisateurController',
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
}