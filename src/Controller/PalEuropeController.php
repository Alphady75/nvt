<?php

namespace App\Controller;

use App\Entity\PalEurope;
use App\Form\PalEuropeType;
use App\Repository\PalEuropeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pal/europe')]
class PalEuropeController extends AbstractController
{
    #[Route('/', name: 'pal_europe_index', methods: ['GET'])]
    public function index(PalEuropeRepository $palEuropeRepository): Response
    {
        return $this->render('pal_europe/index.html.twig', [
            'pal_europes' => $palEuropeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'pal_europe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $palEurope = new PalEurope();
        $form = $this->createForm(PalEuropeType::class, $palEurope);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($palEurope);
            $entityManager->flush();

            return $this->redirectToRoute('pal_europe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pal_europe/new.html.twig', [
            'pal_europe' => $palEurope,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'pal_europe_show', methods: ['GET'])]
    public function show(PalEurope $palEurope): Response
    {
        return $this->render('pal_europe/show.html.twig', [
            'pal_europe' => $palEurope,
        ]);
    }

    #[Route('/{id}/edit', name: 'pal_europe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PalEurope $palEurope, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PalEuropeType::class, $palEurope);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('pal_europe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pal_europe/edit.html.twig', [
            'pal_europe' => $palEurope,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'pal_europe_delete', methods: ['POST'])]
    public function delete(Request $request, PalEurope $palEurope, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$palEurope->getId(), $request->request->get('_token'))) {
            $entityManager->remove($palEurope);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pal_europe_index', [], Response::HTTP_SEE_OTHER);
    }
}
