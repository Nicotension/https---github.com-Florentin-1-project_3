<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MapController extends AbstractController
{
    
      #[Route("/map", name:"app_map")]
     
    public function index(): Response
    {
        $googleMapsApiKey = 'AIzaSyBlszBfP3fe1gP973fh222FqkyjXkeErnA';

        return $this->render('map/index.html.twig', [
            'google_maps_api_key' => $googleMapsApiKey,
        ]);
    }

    
}