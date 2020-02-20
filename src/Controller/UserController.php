<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * @Route("/user", name="user_edit")
     */
    public function user_edit()
    {
        return $this->render('user/edit.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
