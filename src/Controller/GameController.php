<?php

namespace App\Controller;

use App\Entity\Questions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     */
    public function index(): Response
    {
        $questions = $this->getDoctrine()->getRepository(Questions::class);
        $questions = $questions->findAll();
        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
            'questions' => $questions,
        ]);
    }
}
