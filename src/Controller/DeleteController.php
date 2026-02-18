<?php

namespace App\Controller;

use App\Entity\Theme;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DeleteController extends AbstractController
{
    #[Route('/delete', name: 'delete')]
    public function delete(Theme $theme, Request $request, EntityManagerInterface $entityManager): Response
    {
        if($this->isCsrfTokenValid("SUP". $theme->getId(),$request->get('_token'))){
            $entityManager->remove($theme);
            $entityManager->flush();
            $this->addFlash("success","La suppression a été effectuée !");
            return $this->redirectToRoute("accueil");
        }
    }
}
