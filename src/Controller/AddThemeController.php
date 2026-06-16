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
        // création d'un nouveau theme
        $theme = new Theme();

        // création du formulaire en indiquant sur quel theme il va travailler
        $form = $this->createForm(ThemeType::class, $theme);

        // indique de prendre les données et de les associer au formulaire
        $form->handleRequest($request);

        // Verifie si le formulaire est soumis et qu il est valide
        if ($form->isSubmitted() && $form->isValid()){
            $theme->setUser($this->getUser());

            // marque l'entité à sauvegarder
            $entityManager->persist($theme);

            // execute les modifications
            $entityManager->flush(); 

            $this->addFlash('success-add','Votre thème est ajouté avec succès !');
            return $this->redirectToRoute('galerie');
        }
        return $this->render('add_theme/add_theme.html.twig', [
            'themeform' => $form->createView(),
        ]);
    }
}
