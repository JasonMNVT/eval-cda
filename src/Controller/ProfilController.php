<?php

namespace App\Controller;

use App\Repository\AnnonceListByUserRepository;
use App\Repository\ComputerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil', methods: ['GET'])]
    public function index(ComputerRepository $computerRepository, AnnonceListByUserRepository $annonceListByUserRepository): Response
    {
        $author = $this->getUser();
        return $this->render('profil/profil.html.twig', [
            'computers' => $computerRepository->findBy([
                'author' => $author
            ]),
            'annoncesFav' => $annonceListByUserRepository->findBy([
                'users' => $author
            ])
        ]);
    }
}
