<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SolutionController extends Controller
{
    /**
     * @Route("/solution", name="solution")
     */
    public function index()
    {
        return $this->render('solution/index.html.twig', [
            'controller_name' => 'SolutionController',
        ]);
    }
}
