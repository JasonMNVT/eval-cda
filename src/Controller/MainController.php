<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Repository\BrandRepository;
use App\Repository\ComputerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(ComputerRepository $computerRepository, BrandRepository $brandRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'computers' => $computerRepository->findAll(),
            'brands' => $brandRepository->findAll(),
        ]);
    }

    #[Route('/card/{id}', name: 'card', methods: ['GET'])]
    public function card(Brand $brand, ComputerRepository $computerRepository, BrandRepository $brandRepository): Response
    {
        return $this->render('main/card.html.twig', [
            'marq' => $brand,
            'annonces' => $computerRepository->findAll(),
            'marques' => $brandRepository->findAll(),
        ]);
    }
}
