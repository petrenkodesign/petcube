<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(Request $request)
    {
        if($request->get('method') == 'delete') {
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository("App\Entity\User")->find($request->get('id'));
            $em->remove($user);
            $em->flush();
        }

        if($request->get('method') == 'approve' || $request->get('method') == 'decline') {
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository("App\Entity\User")->find($request->get('id'));
            $status = $request->get('method') == 'approve' ? true : false;
            $user->setApproved(true);
            $em->flush();
        }

        
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository("App\Entity\User")->findAll();

        return $this->render('admin/index.html.twig', [
            'users' => $users,
        ]);
    }
}
