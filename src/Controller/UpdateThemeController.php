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
        // création du formulaire en indiquant l'objet sur lequel il va travailler
        $form = $this->createForm(ThemeType::class, $theme);

        // indique de prendre les données et de les associer au formulaire
        $form->handleRequest($request);

        // Verifie si le formulaire est soumis et qu il est valide
        if ($form->isSubmitted() && $form->isValid()){

            // marque l'entité à sauvegarder et à envoyer en bdd
            $entityManager->persist($theme);
            
            // execute les modifs et envoie en bdd
            $entityManager->flush();

            // message get
            $this->addFlash('success-modif','Le thème a été modifié avec succès !');

            // redirection
            return $this->redirectToRoute('galerie');
        }
        return $this->render('update_theme/update_theme.html.twig', [
            'themeform' => $form->createView(),
        ]);
    }
}
