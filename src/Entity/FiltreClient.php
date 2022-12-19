<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Persistence\ObjectManager;

class FiltreClient
{
   /**
    * @var int
    */
   public $page = 1;

   /**
    * @var string|null
    */
   public $q = null;
}