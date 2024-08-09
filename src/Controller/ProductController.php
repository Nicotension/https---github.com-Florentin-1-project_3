<?php

namespace App\Controller;


use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Service\FileUploader;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; // Use Annotation instead of Attribute for Symfony 5.4 and earlier
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ReviewRepository;
use App\Repository\QuestionsRepository;

#[Route('/product')]
class ProductController extends AbstractController
{
        
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/', name: 'app_product_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/catalog', name: 'app_product_catalog', methods: ['GET'])]
    public function catalog(ProductRepository $productRepository): Response
    {
        return $this->render('product/catalog.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_product_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picture = $form->get('picture')->getData();
            if ($picture) {
                $pictureName = $fileUploader->upload($picture);
                $product->setPicture($pictureName);
            } else {
                $product->setPicture("placeholer.jpg");
            }
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $entityManager, ReviewRepository $reviewRepository, QuestionsRepository $questionsRepository): Response
    {
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        
        $reviews = $reviewRepository->findBy(['product' => $product]);
        $questions = $questionsRepository->findBy(['fk_product_id' => $product]);

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'reviews' => $reviews,
            'questions' => $questions,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picture = $form->get('picture')->getData();
            if ($picture) {
                if ($product->getPicture() != "placeholder.jpg") {
                    unlink($this->getParameter("picture_directory") . "/" . $product->getPicture());
                }
                $pictureName = $fileUploader->upload($picture);
                $product->setPicture($pictureName);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            if ($product->getPicture() != "placeholder.jpg") {
                unlink($this->getParameter("picture_directory") . "/" . $product->getPicture());
            }
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route("/product/list", name: 'app_product_list', methods: ['GET'])]
    public function list(): Response
    {
        $products = $this->doctrine->getRepository(Product::class)->findAll();

        return $this->render('product/list.html.twig', [
            'products' => $products,
        ]);
    }
}
