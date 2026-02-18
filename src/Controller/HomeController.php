<?php

namespace App\Controller;

use App\Repository\ThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(ThemeRepository $repository): Response
    {
        $themes = $repository->findThree();
        return $this->render('home/accueil.html.twig', [
            'themes' => $themes,
        ]);
    }
}
