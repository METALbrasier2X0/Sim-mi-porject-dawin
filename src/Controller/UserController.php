<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


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
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            $this->email_registration($user->getUsername(),$user->getEmail(),$mailer);

            return $this->redirectToRoute('connexion');
        }

        return $this->render('user/registration.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="connexion")
     */ 
    public function login(){
    
        return $this->render('user/login.html.twig');
    }

      /**
     * @Route("/deconnexion", name="deconnexion")
     */ 
    public function logout(){}

    public function email_registration($name, $email, \Swift_Mailer $mailer){
        $message = (new \Swift_Message('Vous vous êtes inscris sur SIM'))
            ->setFrom('simdawin@gmail.com')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                    // templates/emails/registration.html.twig
                    'email/registration.html.twig',
                    ['name' => $name]
                ),
                'text/html'
            )
            /*
            * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'emails/registration.txt.twig',
                    ['name' => $name]
                ),
                'text/plain'
            )
            */
            ;

        $mailer->send($message);
    }

}
