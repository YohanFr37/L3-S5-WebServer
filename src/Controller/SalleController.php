<?php

namespace App\Controller;

use App\Entity\Salle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SalleController
 * @package App\Controller
 * @Route("/", name="salle")
 */
class SalleController extends AbstractController
{
    /**
     * @Route("/salle", name="salle")
     */
    public function index(): Response
    {
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $salle = $this->getDoctrine()->getRepository(Salle::class);
        $salle = $salle->findAll();

        return $this->render('salle/index.html.twig', [
            'salles' => $salle,
        ]);

        return $this->render('salle/index.html.twig', [
            'controller_name' => 'SalleController',
        ]);
    }
    
}