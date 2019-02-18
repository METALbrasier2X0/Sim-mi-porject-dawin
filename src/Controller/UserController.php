<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegistrationType;


class UserController extends Controller
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    
    /**
     * @Route("/inscription", name="inscription")
     */ 
    public function registration()
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        return $this->render('user/registration.html.twig',[
            'form' => $form->createView()
        ]);
    }

}
