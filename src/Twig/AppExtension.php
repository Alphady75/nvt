<?php

namespace App\Twig;

use App\Repository\UserRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $userRepository;

    private $signatureRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getYear', [$this, 'getYear']),
        ];
    }

    public function users(): array
    {
        return $this->userRepository->findBy([
            'isVerified'    =>  1
        ], ['id'    =>  'DESC'], 16);
    }

    public function getConnectedUsers(): array
    {
        return $this->userRepository->findBy(['connected' => 1]);
    }

    public function getYear()
    {   
        $year = date('Y');
        return $year;
    }
}


