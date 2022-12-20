<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\FiltreCommande;
use App\Form\FiltreCommandeType;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use App\Services\MailerService;
use App\Services\QrcodeService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commandes')]
class CommandeController extends AbstractController
{
    #[Route('/', name: 'commande_index', methods: ['GET'])]
    public function index(CommandeRepository $commandeRepository, Request $request): Response
    {
        $search = new FiltreCommande();
        $search->page = $request->get('page', 1);

        $form = $this->createForm(FiltreCommandeType::class, $search);
        $form->handleRequest($request);

        $commandes = $commandeRepository->findSearch($search);

        return $this->render('commande/index.html.twig', [
            'commandes' => $commandes,
            'form' => $form->createView(),
            'currente' => $search->page,
        ]);
    }

    #[Route('/new', name: 'commande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, QrcodeService $qrcodeService, MailerService $mailer): Response
    {
        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $commande->setUser($this->getUser());
            $entityManager->persist($commande);
            $entityManager->flush();

            $qrvalues = $commande->getClient()->getId();

            $qrcode = $qrcodeService->qrcode($qrvalues);
            $commande->setQrcode($qrcode);
            $entityManager->flush();

            // Envoie du mail à l'admin
            $mailer->sendMail(
                'nevrety@gmail.com',
                'nevrety@gmail.com',
                'Nouvelle commande',
                'mails/conducteur_mail.html.twig',
                $commande
            );

            // Envoie du mail au conducteur
            $mailer->sendMail(
                'nevrety@gmail.com',
                $commande->getConducteur()->getEmail(),
                'Nouvelle commande',
                'mails/conducteur_mail.html.twig',
                $commande
            );

            // Envoie du mail au client
            $mailer->sendMail(
                'nevrety@gmail.com',
                $commande->getClient()->getEmail(),
                'Nouvelle commande',
                'mails/conducteur_mail.html.twig',
                $commande
            );

            $this->addFlash('success', 'Commande crée avec succès');

            return $this->redirectToRoute('commande_show', ['id' => $commande->getId()],Response::HTTP_SEE_OTHER);
        }

        return $this->render('commande/new.html.twig', [
            'commande' => $commande,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'commande_show', methods: ['GET'])]
    public function show(Commande $commande): Response
    {
        return $this->render('commande/show.html.twig', [
            'commande' => $commande,
        ]);
    }

    #[Route('/{id}/edit', name: 'commande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commande $commande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Commande modifiée avec succès');

            return $this->redirectToRoute('commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commande/edit.html.twig', [
            'commande' => $commande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'commande_delete', methods: ['POST'])]
    public function delete(Request $request, Commande $commande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commande->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commande);
            $entityManager->flush();

            $this->addFlash('success', 'Commande supprimer avec succès');
        }

        return $this->redirectToRoute('commande_index', [], Response::HTTP_SEE_OTHER);
    }
}