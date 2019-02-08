<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class TestTableController extends Controller
{
    /**
     * @Route("/test/table", name="test_table")
     */
    public function index()
    {
        return $this->render('test_table/index.html.twig', [
            'controller_name' => 'TestTableController',
        ]);
    }
    
}
