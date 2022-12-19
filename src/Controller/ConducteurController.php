<?php

namespace App\Controller;

use App\Entity\Conducteur;
use App\Form\ConducteurType;
use App\Repository\ConducteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/conducteurs')]
class ConducteurController extends AbstractController
{
    #[Route('/', name: 'conducteur_index', methods: ['GET'])]
    public function index(ConducteurRepository $conducteurRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $conducteurs = $paginator->paginate(
            $conducteurRepository->findBy([], ['created' => 'DESC']),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('conducteur/index.html.twig', [
            'conducteurs' => $conducteurs,
        ]);
    }

    #[Route('/new', name: 'conducteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $conducteur = new Conducteur();
        $form = $this->createForm(ConducteurType::class, $conducteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($conducteur);
            $entityManager->flush();

            $this->addFlash('success', 'Conducteur cré avec succès');

            return $this->redirectToRoute('conducteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conducteur/new.html.twig', [
            'conducteur' => $conducteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'conducteur_show', methods: ['GET'])]
    public function show(Conducteur $conducteur): Response
    {
        return $this->render('conducteur/show.html.twig', [
            'conducteur' => $conducteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'conducteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conducteur $conducteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConducteurType::class, $conducteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Conducteur modifié avec succès');

            return $this->redirectToRoute('conducteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conducteur/edit.html.twig', [
            'conducteur' => $conducteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'conducteur_delete', methods: ['POST'])]
    public function delete(Request $request, Conducteur $conducteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conducteur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($conducteur);
            $entityManager->flush();

            $this->addFlash('success', 'Conducteur supprimer avec succès');
        }

        return $this->redirectToRoute('conducteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
