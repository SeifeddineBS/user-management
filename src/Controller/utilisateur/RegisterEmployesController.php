<?php

namespace App\Controller\utilisateur;

use App\Entity\Role;
use App\Entity\Utilisateur;
use App\Form\RegisterEmployesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterEmployesController extends AbstractController
{
    /**
     * @Route("/register/employes", name="app_register_employes")
     */
    public function index(): Response
    {
        return $this->render('register_employes/index.html.twig', [
            'controller_name' => 'RegisterEmployesController',
        ]);
    }
     /**
     * @Route("/ajouter/employee",name="ajout_employee")
     */
    public function AjouterEmployee(Request $request)
    {
        $user=new Utilisateur();
        $form = $this->createForm(RegisterEmployesType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $role=new Role();
            $role->setIdRole(2);
        $user->setIdRole( $role );
        $em=$this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('app_register_employes');
        }
        return $this->render('register_employes/ajout_user.html.twig', [
            'form' => $form->createView(),
        ]);

        
    }

}
