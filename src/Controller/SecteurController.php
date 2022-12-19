<?php

namespace App\Controller;

use App\Entity\Secteur;
use App\Form\SecteurType;
use App\Repository\SecteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/secteurs')]
class SecteurController extends AbstractController
{
    #[Route('/', name: 'secteur_index', methods: ['GET'])]
    public function index(SecteurRepository $secteurRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $secteurs = $paginator->paginate(
            $secteurRepository->findBy([], ['created' => 'DESC']),
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('secteur/index.html.twig', [
            'secteurs' => $secteurs,
        ]);
    }

    #[Route('/new', name: 'secteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $secteur = new Secteur();
        $form = $this->createForm(SecteurType::class, $secteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($secteur);
            $entityManager->flush();

            $this->addFlash('success', 'Secteur cré avec succès');

            return $this->redirectToRoute('secteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('secteur/new.html.twig', [
            'secteur' => $secteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'secteur_show', methods: ['GET'])]
    public function show(Secteur $secteur): Response
    {
        return $this->render('secteur/show.html.twig', [
            'secteur' => $secteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'secteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Secteur $secteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SecteurType::class, $secteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Secteur modifier avec succès');

            return $this->redirectToRoute('secteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('secteur/edit.html.twig', [
            'secteur' => $secteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'secteur_delete', methods: ['POST'])]
    public function delete(Request $request, Secteur $secteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$secteur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($secteur);
            $entityManager->flush();

            $this->addFlash('success', 'Secteur supprimer avec succès');
        }

        return $this->redirectToRoute('secteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
