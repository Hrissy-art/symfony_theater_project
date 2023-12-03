<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'list_articles')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
        return $this->render('article/list.html.twig', [
            'articles' => $articles,
          'title' => 'Show list'
        ]);
    }
    #[Route('/articles/{id<\d+>}', name: 'item_article')]
        public function item(ArticleRepository $articleRepository, $id): response
        {
            $article = $articleRepository->find($id);
            return $this->render('article/item.html.twig', [
    'article' => $article,
            ]);
        }
    
        #[Route('/articles/new',name: 'new_article' )]
        public function new(Request $request, EntityManagerInterface $em) : Response
     
        {
            $article = new Article();
    
            $form = $this->createForm(ArticleType::class, $article);
            $form -> handleRequest($request);
    
    if ($form ->isSubmitted() && $form ->isValid())
    {
        
        $article->setCreatedOn(new \DateTime());
        $article->setVisible(true);
        // foreach ($article->getTheaters() as $theater) {
        //     $em->persist($theater);
        

        $em->persist($article);
        $em-> flush();
    
        return $this ->redirectToRoute('home');
    }
    return $this->renderForm("article/new.html.twig",
            ['article_form' => $form]);
        }
        #[Route('/articles/me', name: 'articles_me')]
        public function articlesByConnectedUser(): Response
        {
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            $user = $this->getUser();
    
            if (!$user instanceof User) {
                return $this->redirectToRoute('home');
            }
    
            $articles = $user->getName();
    
            return $this->render('article/me.html.twig', ['articles' => $articles]);
        }
       
    }

