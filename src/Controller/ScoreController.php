<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Score;
use App\Entity\User;
use App\Repository\ScoreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ScoreController extends Controller
{
    /**
     * @Route("/score", name="score")
     */
    public function index(ScoreRepository $ScoreRepository)
    {
        return $this->render('score/index.html.twig', ['Scores' => $ScoreRepository->findAllScoreByUser($this->getUser()->getId())]);
    }

    /**
     * @Route("/saveScore", name="saveScore", methods={"GET","POST"})
     */
    public function saveScore()
    {
        return;
    }
}
