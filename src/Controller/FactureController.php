<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Facture;
use App\Form\FactureType;
use App\Repository\CommandeRepository;
use App\Repository\FactureRepository;
use App\Services\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Dompdf\Dompdf;
use Dompdf\Options;

#[Route('/facturation')]
class FactureController extends AbstractController
{
    #[Route('/', name: 'facture_index', methods: ['GET'])]
    public function index(FactureRepository $factureRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $factures = $paginator->paginate(
            $factureRepository->findBy([], ['created' => 'DESC']),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('factures/index.html.twig', [
            'factures' => $factures,
        ]);
    }

    #[Route('/new', name: 'facture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $facture = new Facture();
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($facture);
            $entityManager->flush();

            return $this->redirectToRoute('facture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('factures/new.html.twig', [
            'facture' => $facture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'facture_show', methods: ['GET'])]
    public function show(Facture $facture): Response
    {
        return $this->render('factures/show.html.twig', [
            'facture' => $facture,
        ]);
    }

    #[Route('/{id}/edit', name: 'facture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Facture $facture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('facture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('factures/edit.html.twig', [
            'facture' => $facture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'facture_delete', methods: ['POST'])]
    public function delete(Request $request, Facture $facture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $facture->getId(), $request->request->get('_token'))) {
            $entityManager->remove($facture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('facture_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/generer/{id}', name: 'generer_facture', methods: ['POST'])]
    public function factureRenener(
        Request $request,
        Commande $commande,
        EntityManagerInterface $entityManager
    ): Response {
        if ($this->isCsrfTokenValid('generer', $request->request->get('_token'))) {
            // 1- Définition des options de pdf
            $pdfOptions = new Options();

            // 1-a Police par défaut
            $pdfOptions->set('defaultFont', 'Courier');

            $pdfOptions->setIsRemoteEnabled(true);

            // 2 - Instanciation de Dompdf
            $dompdf = new Dompdf($pdfOptions);

            // 2 - Gestion du context
            $context = stream_context_create([
                'ssl'   =>  [
                    'verify_peer'   => FALSE,
                    'verify_peer_name' => FALSE,
                    'allow_self_signed' => TRUE
                ]
            ]);

            // 2 - Transmission du context à Dompdf
            $dompdf->setHttpContext($context);

            // 3 - Génération du Html
            $html = $this->renderView('factures/genererpdf.html.twig', [
                // Passer des informations
                'commande' => $commande,
            ]);

            // 4 - Transmission du Html généré par twig à Dompdf
            $dompdf->loadHtml($html);
            //*** Dimenssion de la feuille
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $nomsClient = $commande->getClient()->getNom() . ' ' . $commande->getClient()->getPrenom();

            // 5 - Génération du nom de fichier
            $file = 'Facture de ' . $nomsClient . '.pdf';

            // 6 - Envoie du pdf au navigateur
            $dompdf->stream($file, [
                'Attachment' => true,
            ]);

            $facture = new Facture();
            $facture->setDesignation($nomsClient);
            $facture->setClient($commande->getClient());
            $facture->setCommande($commande);
            $facture->setDocument($file);
            $facture->setStatut(false);
            $facture->setReceved(false);
            $entityManager->persist($facture);
            $entityManager->flush();

            return new Response();
        }
    }

    #[Route('/client/{id}', name: 'client_generer_facture', methods: ['POST'])]
    public function userFactures(Request $request, Client $client, EntityManagerInterface $entityManager, BuilderInterface $builder): Response
    {
        if ($this->isCsrfTokenValid('genererfactures' . $client->getId(), $request->request->get('_token'))) {
            // 1- Définition des options de pdf
            $pdfOptions = new Options();

            // 1-a Police par défaut
            $pdfOptions->set('defaultFont', 'Courier');

            $pdfOptions->setIsRemoteEnabled(true);

            // 2 - Instanciation de Dompdf
            $dompdf = new Dompdf($pdfOptions);

            // 2 - Gestion du context
            $context = stream_context_create([
                'ssl'   =>  [
                    'verify_peer'   => FALSE,
                    'verify_peer_name' => FALSE,
                    'allow_self_signed' => TRUE
                ]
            ]);

            // 2 - Transmission du context à Dompdf
            $dompdf->setHttpContext($context);

            // 3 - Génération du Html
            $html = $this->renderView('factures/client_factures_pdf.html.twig', [
                // Passer des informations
                'client' => $client,
                'commandes' => $client->getCommandes(),
            ]);

            // 4 - Transmission du Html généré par twig à Dompdf
            $dompdf->loadHtml($html);
            //*** Dimenssion de la feuille
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $nomsClient = $client->getNom() . ' ' . $client->getPrenom();

            // 5 - Génération du nom de fichier
            $file = 'Facture de ' . $nomsClient . '.pdf';

            // 6 - Envoie du pdf au navigateur
            $dompdf->stream($file, [
                'Attachment' => true,
            ]);

            $facture = new Facture();

            $facture->setDesignation($nomsClient);
            $facture->setClient($client);
            $facture->setDocument($file);
            $facture->setStatut(false);
            $entityManager->persist($facture);
            $entityManager->flush();

            return new Response();
        }
    }

    #[Route('/commande/client/{commandeId}/{factureId}', name: 'send_client_facture', methods: ['POST'])]
    public function sendClientFacture(CommandeRepository $commandeRepo, FactureRepository $factureRepo, MailerService $mailer, $commandeId, $factureId,  EntityManagerInterface $entityManager, Request $request): Response 
    {
        $commande = $commandeRepo->find($commandeId);

        $facture = $factureRepo->find($factureId);

        if (!$commande) {
            dd('Aucune commande');
        }
        
        if (!$facture) {
            dd('Aucune commande');
        }

        if ($this->isCsrfTokenValid('send_client_mail' . $commande->getId(), $request->request->get('_token'))) {
            // Envoie du mail au client
            $mailer->sendMail(
                'nevrety@gmail.com',
                $commande->getClient()->getEmail(),
                'Transmission de la facture',
                'mails/client_mail.html.twig',
                $commande
            );

            $facture->setStatut(true);
            $entityManager->persist($facture);
            $entityManager->flush();

            $this->addFlash('success', 'La facture a bien été envoyer au client ' . $commande->getClient()->getEmail());
            
        }else{
            $this->addFlash('danger', 'La facture n\'a pas été envoyer au client ' . $commande->getClient()->getEmail());
        }

        return $this->redirectToRoute('facture_index');
    }
}
