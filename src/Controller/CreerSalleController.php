<?php

namespace App\Controller;
use App\Form\CreerSalleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CreerSalleController extends AbstractController
{
    /**
     * @Route("/creer_salle", name="creer_salle")
     * @param Request $request
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(CreerSalleType::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData()->getCategory();
            $difficulty = $form->getData()->getDifficulty();
            return $this->redirect($this->generateUrl('game', array('length' => 10, 't' => $category, 'd' => $difficulty)));
        }
        

        return $this->render('creer_salle/index.html.twig', [
            'controller_name' => 'CreerSalleController',
            "form" => $form->createView(),
        ]);
    }
}
