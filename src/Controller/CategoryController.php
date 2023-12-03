<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'list_categories')]
    public function list(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }
    #[Route('/categories/{id<\d+>}', name: 'category_item')]
    public function item(CategoryRepository $categoryRepository, int $id): Response
    {
        $category = $categoryRepository->find($id);
        if ($category === null) {
            throw new FileNotFoundException('Not found');
        }
        return $this->render('category/item.html.twig', [
            'category' => $category,
        ]);
    }
    #[Route('/new', name: 'new_category')]
    public function new(Request $request, EntityManagerInterface $entity): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entity->persist($category);
            $entity->flush();
        }
        return $this->renderForm(
            'category/new.html.twig',
            ['form_cat' => $form]
        );
    }

}
