<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Theme;
use App\Form\CommentType;
use App\Repository\ThemeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ThemeController extends AbstractController
{
    // #[Route('/theme/{id}', name: 'theme')]
    //  public function index(ThemeRepository $repository): Response
    // {
    //     $themes = $repository->findAll();
    //     return $this->render('theme/theme.html.twig', [
    //         'themes' => $themes,
    //     ]);
    // }

    #[Route('/theme/{id}', name: 'theme')]
    
    public function commentary(ThemeRepository $repository, Theme $themes, Request $request, Security $security, EntityManagerInterface $entityManager): Response
    {
        
        $comment = new Comment;
        
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $comment->setUser($security->getUser());
            $comment->setTheme($themes);
            $entityManager->persist($comment);
            $entityManager->flush();
            $this->addFlash('success-comment','Votre commentaire est ajouté avec succès !');
            return $this->redirectToRoute('theme', ['id' => $themes->getId()]);
        }
        
       
        $themes = $repository->findOneBy(["id"=>$themes->getId()]);
        
        return $this->render('theme/theme.html.twig', [
            'themes' => $themes,
            'commentform' => $form->createView(),
        ]);
    }
}
