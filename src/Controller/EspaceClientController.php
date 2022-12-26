<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\ChangePasswordFormType;
use App\Form\EditProfileType;
use App\Repository\CommandeRepository;
use App\Repository\FactureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Dompdf\Dompdf;
use Dompdf\Options;

#[Route('/espace-client')]
class EspaceClientController extends AbstractController
{
    #[Route('/commande/{id}', name: 'client_commande_facture', methods: ['GET'])]
    public function show(Commande $commande): Response
    {
        return $this->render('espace_client/commande.html.twig', [
            'commande' => $commande,
        ]);
    }

    #[Route('/generer/{commandeId}', name: 'ma_facture', methods: ['POST'])]
    public function factureRenener(
        Request $request, CommandeRepository $commandeRepo,
        FactureRepository $factureRepo,
        EntityManagerInterface $entityManager, $commandeId
    ): Response {

        $commande = $commandeRepo->find($commandeId);

        $facture = $factureRepo->findOneBy(['commande' => $commande]);

        if (!$commande) {
            dd('Aucune commande');
        }
        
        if (!$facture) {
            dd('Aucune commande');
        }

        if ($this->isCsrfTokenValid('mafacture', $request->request->get('_token'))) {
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
            
            $facture->setReceved(true);
            $entityManager->persist($facture);
            $entityManager->flush();

            return new Response();
        }
    }
}