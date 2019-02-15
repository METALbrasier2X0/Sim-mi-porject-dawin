<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Etape;
use App\Entity\Question;
use App\Repository\EtapeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        return $this->render('ingame/planification.html.twig',  ['Etapes' => $EtapeRepository->findAll()]);
    }

    /**
     * @Route("/chantier", name="chantier", methods={"GET","POST"})
     */
    public function chantier(Request $request, EtapeRepository $EtapeRepository)
    {

        $getPlanification = $this->get('session')->get('varPlanification');


        return $this->render('ingame/chantier.html.twig', ['getPlanifications' => $EtapeRepository->findById($getPlanification)]);
    }

    /**
     * @Route("/chantierAjax", name="chantierAjax", methods={"GET","POST"})
     */
    public function chantierAjax(Request $request)
    {
        $this->get('session')->set('varPlanification', array($_GET['1'], $_GET['2'], $_GET['3'], $_GET['4'], $_GET['5']));
        dump($this->get('session'));
        return $this->render('ingame/chantierAjax.html.twig');
    }

}
