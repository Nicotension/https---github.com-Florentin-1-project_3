<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CatalogController extends AbstractController
{
    #[Route('/catalog', name: 'app_catalog')]
    public function index(): Response
    {
        $products = [
            ['id' => 3, 'name' => 'Art Creative Set', 'availability' => 'In Stock', 'description' => 'Ideal for all age', 'picture' => 'image1.jpg'],
            ['id' => 4, 'name' => 'Barbie clothes Collection', 'availability' => 'In Stock', 'description' => 'Ideal for kids between 2 - 6years',  'picture' => 'image2.jpg'],
            ['id' => 5, 'name' => 'Ring Toss', 'availability' => 'In Stock', 'description' => 'Ideal for kids and a good outdoor game', 'picture' => 'image3.jpg'],
            ['id' => 6, 'name' => 'Barbie Rider', 'availability' => 'In Stock', 'description' => 'Ideal for kids',  'picture' => 'image4.jpg'],
            ['id' => 7, 'name' => 'Mini Basket Set', 'availability' => 'In Stock', 'description' => 'Good for matured kids and specially for outdoors',  'picture' => 'image5.jpg'],
            ['id' => 9, 'name' => 'Chess', 'availability' => 'In Stock', 'description' => 'Ideal for kids and young adults', 'picture' => 'image6.jpg'],
            ['id' => 10, 'name' => 'Baby Iplay Set', 'availability' =>'In Stock', 'description' => 'Ideal for babys, 1 -11 months',  'picture' => 'image7.jpg'],
            ['id' => 11, 'name' => 'Builder', 'price' => 100, 'availability' => 'In Stock', 'description' => 'Ideal for kids between 5 - 10 years', 'picture' => 'image8.jpg'],
            ['id' => 12, 'name' => 'Shooting Sport Game', 'price' => 200, 'availability' => 'Out of Stock', 'description' => 'Ideal for kids between 7- 15 years',  'picture' => 'image9.jpg'],
        //     ['id' => 13, 'name' => 'Product 1', 'price' => 100, 'availability' => 'In Stock', 'description' => 'Ideal for kids', 'picture' => 'public/uploads/'],
        //     ['id' => 14, 'name' => 'Product 2', 'price' => 200, 'availability' => 'Out of Stock', 'description' => 'Ideal for kids',  'picture' => 'public/uploads/'],
        //     ['id' => 15, 'name' => 'Product 1', 'price' => 100, 'availability' => 'In Stock', 'description' => 'Ideal for kids', 'picture' => 'public/uploads/'],
        //     ['id' => 16, 'name' => 'Product 2', 'price' => 200, 'availability' => 'Out of Stock', 'description' => 'Ideal for kids',  'picture' => 'public/uploads/'],
        //     ['id' => 17, 'name' => 'Product 1', 'price' => 100, 'availability' => 'In Stock', 'description' => 'Ideal for kids', 'picture' => 'public/uploads/'],
        //     ['id' => 18, 'name' => 'Product 2', 'price' => 200, 'availability' => 'Out of Stock', 'description' => 'Ideal for kids',  'picture' => 'public/uploads/'],
        //     ['id' => 19, 'name' => 'Product 1', 'price' => 100, 'availability' => 'In Stock', 'description' => 'Ideal for kids', 'picture' => 'public/uploads/'],
        //     ['id' => 20, 'name' => 'Product 2', 'price' => 200, 'availability' => 'Out of Stock', 'description' => 'Ideal for kids',  'picture' => 'public/uploads/'],
        //     ['id' => 21, 'name' => 'Product 1', 'price' => 100, 'availability' => 'In Stock', 'description' => 'Ideal for kids', 'picture' => 'public/uploads/'],
        //     ['id' => 22, 'name' => 'Product 2', 'price' => 200, 'availability' => 'Out of Stock', 'description' => 'Ideal for kids',  'picture' => 'public/uploads/'], 
        //     ['id' => 23, 'name' => 'Product 1', 'price' => 100, 'availability' => 'In Stock', 'description' => 'Ideal for kids', 'picture' => 'public/uploads/'],
        //     ['id' => 24, 'name' => 'Product 2', 'price' => 200, 'availability' => 'Out of Stock', 'description' => 'Ideal for kids',  'picture' => 'public/uploads/'],
        //     ['id' => 19, 'name' => 'Product 1', 'price' => 100, 'availability' => 'In Stock', 'description' => 'Ideal for kids', 'picture' => 'public/uploads/'],
        //     ['id' => 20, 'name' => 'Product 2', 'price' => 200, 'availability' => 'Out of Stock', 'description' => 'Ideal for kids',  'picture' => 'public/uploads/'],
        //     ['id' => 21, 'name' => 'Product 1', 'price' => 100, 'availability' => 'In Stock', 'description' => 'Ideal for kids', 'picture' => 'public/uploads/'],
        //     ['id' => 22, 'name' => 'Product 2', 'price' => 200, 'availability' => 'Out of Stock', 'description' => 'Ideal for kids',  'picture' => 'public/uploads/'], 
        //     ['id' => 23, 'name' => 'Product 1', 'price' => 100, 'availability' => 'In Stock', 'description' => 'Ideal for kids', 'picture' => 'public/uploads/'],
        //     ['id' => 24, 'name' => 'Product 2', 'price' => 200, 'availability' => 'Out of Stock', 'description' => 'Ideal for kids',  'picture' => 'public/uploads/'], // More products...
        // 
    ];
        
        return $this->render('catalog/index.html.twig', [
            'products' => $products,
             'controller_name' => 'CatalogController',
        ]);
    }
}
