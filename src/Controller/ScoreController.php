<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Score;
use App\Entity\User;
use App\Repository\ScoreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;

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
    public function saveScore(ObjectManager $em)
    {
        $temp = new Score();

        $temp->setIsUser($this->getUser());
        $temp->setSatisfactionC(25);
        $temp->setReputationP(10);
        $temp->setReputationE(10);
        $temp->setCreation_Partie(new \DateTime());


        $em->persist($temp);
        $em->flush();

        return new Response("Saved!");
    }
}
