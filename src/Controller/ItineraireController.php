<?php

namespace App\Controller;

use App\Entity\Itineraire;
use App\Form\ItineraireType;
use App\Repository\ItineraireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/itineraire')]
class ItineraireController extends AbstractController
{
    #[Route('/', name: 'itineraire_index', methods: ['GET'])]
    public function index(ItineraireRepository $itineraireRepository): Response
    {
        return $this->render('itineraire/index.html.twig', [
            'itineraires' => $itineraireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'itineraire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $itineraire = new Itineraire();
        $form = $this->createForm(ItineraireType::class, $itineraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($itineraire);
            $entityManager->flush();

            return $this->redirectToRoute('itineraire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('itineraire/new.html.twig', [
            'itineraire' => $itineraire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'itineraire_show', methods: ['GET'])]
    public function show(Itineraire $itineraire): Response
    {
        return $this->render('itineraire/show.html.twig', [
            'itineraire' => $itineraire,
        ]);
    }

    #[Route('/{id}/edit', name: 'itineraire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Itineraire $itineraire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ItineraireType::class, $itineraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('itineraire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('itineraire/edit.html.twig', [
            'itineraire' => $itineraire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'itineraire_delete', methods: ['POST'])]
    public function delete(Request $request, Itineraire $itineraire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$itineraire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($itineraire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('itineraire_index', [], Response::HTTP_SEE_OTHER);
    }
}
