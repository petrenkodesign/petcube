<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserPassType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordUpgradeController extends AbstractController
{
    /**
     * @Route("/password", name="password")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // get current user data
        $currentUser = $this->getUser();

        // If the user is not logged in, redirect to the login page
        if(!$this->getUser()) {
            return $this->redirectToRoute('login');
        }

        // create new form instance
        $form = $this->createForm(UserPassType::class);

        // handle the request from the form submission
        $form->handleRequest($request);
       
        // check if the form is submitted and valid and the current password is valid
        if (
            $form->isSubmitted() && 
            $form->isValid()
        ) {
            // get cuurent user password from form
            $currentPassword = $form->get('currentpassword')->getData();

            // check if current password is valid
            if(!$passwordEncoder->isPasswordValid($currentUser, $currentPassword)) {
                $this->addFlash('danger', 'Current password is not valid!');
                return $this->redirectToRoute('password');
            }
            
            // get new password from form
            $newPassword = $form->get('newpassword')->getData();

            // check if current password not same as new password
            if($passwordEncoder->isPasswordValid($currentUser, $newPassword)) {
                $this->addFlash('danger', 'The new password must be different from a current!');
                return $this->redirectToRoute('password');
            }

            // encode new password
            $newHashedPassword = $passwordEncoder->encodePassword($currentUser, $newPassword);
            
            // set new password to user entity and save
            $currentUser->setPassword($newHashedPassword);

            // save user entity
            $em = $this->getDoctrine()->getManager();
            $em->persist($currentUser);
            $em->flush();

            $this->addFlash('success', 'Password changed successfully!');
            return $this->redirectToRoute('profile');
        }

        return $this->render('password/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
