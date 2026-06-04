<?php

namespace App\Controller;

use App\Repository\ThemeRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GalerieController extends AbstractController
{
    #[Route('/galerie', name: 'galerie')]
    public function index(ThemeRepository $repository, TypeRepository $typeRepository, Request $request): Response
    {
        $typeId = $request->query->get('type');

        if ($typeId) {
            $themes = $repository->findBy(['type' => $typeId]);
        } else {
            $themes = $repository->findAll();
        }

        $types = $typeRepository->findAll();

        return $this->render('galerie/galerie.html.twig', [
            'themes' => $themes,
            'types' => $types,
            'currentType' => $typeId,
        ]);
    }
}

