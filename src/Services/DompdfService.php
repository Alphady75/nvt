<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;

class DompdfService
{
	public function Download($file)
	{
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
		$html = $this->renderView('admin/admin_diplome/downloadpdf.html.twig', [
                // Passer des informations
			'diplome' => $diplome,
			'signature' => $signature,
		]);

            // 4 - Transmission du Html généré par twig à Dompdf
		$dompdf->loadHtml($html);
            //*** Dimenssion de la feuille
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();

		$noms = $diplome->getNom() . ' ' . $diplome->getNom();

            // 5 - Génération du nom de fichier
		$file = $diplome->getType() . '-de-' . $this->sluger->slug($noms) . '.pdf';

            // 6 - Envoie du pdf au navigateur
		$dompdf->stream($file, [
			'Attachment' => true,
		]);
	}
}