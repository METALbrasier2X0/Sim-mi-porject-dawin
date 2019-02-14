<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Etape;
use App\Entity\Question;
use App\Repository\EtapeRepository;

class EtapeController extends Controller
{
    /**
     * @Route("/etape", name="etape")
     */
    public function index()
    {
        return $this->render('etape/index.html.twig', ['controller_name' => 'EtapeController',]);
    }

    /**
     * @Route("/planification", name="planification")
     */
    public function planification(EtapeRepository $EtapeRepository)
    {
        return $this->render('ingame/planification.html.twig', ['Etapes' => $EtapeRepository->findAll()]);
    }
}
