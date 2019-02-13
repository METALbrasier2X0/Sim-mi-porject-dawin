<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class EtapeController extends Controller
{
    /**
     * @Route("/etape", name="etape")
     */
    public function index()
    {
        return $this->render('etape/index.html.twig', ['controller_name' => 'EtapeController',]);
    }

}
