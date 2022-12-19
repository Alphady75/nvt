<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\User;
use App\Repository\CommandeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

#[Route('/factures')]
class FacturesController extends AbstractController
{
    #[Route('/{id}/generer', name: 'generer_facture', methods: ['POST'])]
    public function factureRenener(Request $request, Commande $commande): Response
    {
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

            return new Response();
        }
    }
    
    #[Route('/client/{id}', name: 'client_generer_facture', methods: ['POST'])]
    public function userFactures(Request $request, Client $client): Response
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

            return new Response();
        }
    }
}