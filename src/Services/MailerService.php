<?php

namespace App\Services;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;

class MailerService
{
   public function __construct(private MailerInterface $mailer)
   {
      
   }

   public function sendMail($from, $to, $sujet, $template, $commande)
   {

      $email = (new TemplatedEmail())
         ->from($from)
         ->to($to)
         ->subject($sujet)
         ->htmlTemplate($template)
         ->context([
            'commande' => $commande,
         ]);

      return $this->mailer->send($email);
   }
}