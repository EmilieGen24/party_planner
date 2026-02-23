<?php

namespace App\Controller;

use App\Entity\Theme;
use App\Form\ThemeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddThemeController extends AbstractController
{
    #[Route('/add/theme', name: 'add_theme')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $theme = new Theme();
        $form = $this->createForm(ThemeType::class, $theme);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($theme);
            $entityManager->flush();
            $this->addFlash('success-add','Votre thème est ajouté avec succès !');
            return $this->redirectToRoute('galerie');
        }
        return $this->render('add_theme/add_theme.html.twig', [
            'themeform' => $form->createView(),
        ]);
    }
}
