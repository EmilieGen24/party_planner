<?php

namespace App\Controller;

use App\Entity\Theme;
use App\Form\ThemeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UpdateThemeController extends AbstractController
{
    #[Route('/update/theme/{id}', name: 'update_theme')]
     public function modify(Theme $theme, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ThemeType::class, $theme);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($theme);
            $entityManager->flush();
            $this->addFlash('success-modif','Le thème a été modifié avec succès !');
            return $this->redirectToRoute('galerie');
        }
        return $this->render('update_theme/update_theme.html.twig', [
            'themeform' => $form->createView(),
        ]);
    }
}
