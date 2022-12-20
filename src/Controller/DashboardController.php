<?php

namespace App\Controller;

use App\Entity\FiltreCommande;
use App\Form\FiltreCommandeType;
use App\Repository\ClientRepository;
use App\Repository\CommandeRepository;
use App\Repository\ConducteurRepository;
use App\Repository\ItineraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Repository\VehiculeRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route('/dashboard')]
class DashboardController extends AbstractController
{
    #[Route('/', name: 'dashboard')]
    public function home(UserRepository $userRepository, CommandeRepository $commandeRepository, ClientRepository $clientRepository, VehiculeRepository $vehiculeRepository, Request $request, ConducteurRepository $conducteurRepository, ItineraireRepository $itineraireRepository): Response
    {
        $search = new FiltreCommande();
        $search->page = $request->get('page', 1);

        $form = $this->createForm(FiltreCommandeType::class, $search);
        $form->handleRequest($request);

        $commandes = $commandeRepository->findSearch($search);
        
        return $this->render('dashboard/home.html.twig', [
            'commandes' => $commandes,
            'form' => $form->createView(),
            'currente' => $search->page,
            'users' => $userRepository->findAll(),
            'clients' => $clientRepository->findAll(),
            'commandesAll' => $commandeRepository->findAll(),
            'vehicules' => $vehiculeRepository->findAll(),
            'conducteurs' => $conducteurRepository->findAll(),
            'itineraires' => $itineraireRepository->findAll()
        ]);
    }
}