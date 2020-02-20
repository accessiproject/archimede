<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{

    /**
     * @Route("/liste-des-utilisateurs", name="user_index")
     */
    public function user_index()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'users' => $users,
        ]);
    }
    
    /**
     * @Route("/user", name="user_edit")
     */
    public function user_edit(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $manager)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            // Encode le mot de passe
            //$password = $passwordEncoder->encodePassword($user, $user->getPassword());
            //$user->setPassword();
            $user->setCreatedat(new \DateTime('now'));    
            $user->setRoles(["ROLE_USER"]);
            
            // Enregistre le membre en base
            
            
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('app_login');
            
        }
        return $this->render('user/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}