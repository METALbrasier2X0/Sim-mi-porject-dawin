<?php

namespace App\Controller;
use App\Entity\testTable;
use App\Repository\TestTableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="test")
     */
    public function index(testTableRepository $testTableRepository)
    {
        return $this->render('home/index.html.twig', ['testTable' => $testTableRepository->findAll()]);
    }

    /**
     * @Route("/chantier", name="chantier")
     */
    public function chantier()
    {
        return $this->render('ingame/chantier.html.twig');
    }

     /**
     * @Route("/menu", name="menu")
     */
    public function menu()
    {
        return $this->render('ingame/menu.html.twig');
    }
    
}
