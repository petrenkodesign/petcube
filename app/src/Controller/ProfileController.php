<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(Request $request)
    {
        // If the user is not logged in, redirect to the login page
        if(!$this->getUser() || !$this->getUser()->getApproved()) {
            return $this->redirectToRoute('login');
        }

        $user =$this->getUser();
    
        return $this->render('profile/index.html.twig', [
            'user' => [
               'Name' => $user->getName(),
               'Email' => $user->getEmail(),
            ],
        ]);
    }
}