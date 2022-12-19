<?php

namespace App\Services;

use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Builder\BuilderInterface;

class QrcodeService
{
	protected $builder;
	
	public function __construct(BuilderInterface $builder)
	{
		$this->builder = $builder;
	}

	public function qrcode($query)
	{
		$result = $this->builder
			->data($query)
			->encoding(new Encoding('UTF-8'))
			->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
			->size(400)
			->margin(10)
			//->labelText('Qr code')
			->build()
		;

		$qrcodePng = uniqid('', '') . '.png';

		$path = \dirname(__DIR__, 2) . '/public/uploads/qr-code/';

		// Stockage de l'image
		$result->saveToFile( ($path . $qrcodePng) );

		return $result->getDataUri();
	}
}