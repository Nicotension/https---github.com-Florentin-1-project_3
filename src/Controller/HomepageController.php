<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(ProductRepository $productRepository): Response
    {
        // Fetch products from the database
        $products = $productRepository->findAll();

        // Render the homepage template with the fetched products
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'products' => $products,
        ]);
    }
}


// namespace App\Controller;

// use App\Repository\ProductRepository;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Attribute\Route;

// class HomepageController extends AbstractController
// {
//     #[Route('/', name: 'app_homepage')]
//     public function index(): Response
//     {
//         return $this->render('homepage/index.html.twig', [
//             'controller_name' => 'HomepageController',
//         ]);
//     }
   
// }
