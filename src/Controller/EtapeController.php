<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Etape;
use App\Entity\Question;
use App\Entity\Reponse;
use App\Repository\EtapeRepository;
use App\Repository\QuestionRepository;
use App\Repository\ReponseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


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

    /**
     * @Route("/loadQuestion", name="loadQuestion", methods={"GET","POST"})
     */
    public function loadQuestion(Request $request, QuestionRepository $QuestionRepository, ReponseRepository $ReponseRepository)
    {
      $id = $_GET['question'];
        $question = $QuestionRepository->findById($id)[0];
        $reponses = $ReponseRepository->findBy(["id_question" => $id]);
        $jsonReponse = array();
        foreach ($reponses as $value) {
            $jsonReponse[] = $value->getLibelle();
        }

      return new JsonResponse(array(
          'question' => array('name'=> $question->getName(),'urlImage'=> $question->getUrlImage(),'textReponse'=> $question->getTextReponse()),
          'reponses' => array($jsonReponse)
        ));
      //return $this->render('ingame/loadQuestion.html.twig', ['getQuestions' => $QuestionRepository->findById($id) , 'getReponses' => $ReponseRepository->findBy(["id_question" => $id])]);
    }

}
