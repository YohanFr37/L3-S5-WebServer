<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Questions;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {

        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $article = $this->getDoctrine()->getRepository(Article::class);
        $article = $article->findBy( 
            array(), 
            array('id' => 'DESC'),
            3,
          ); 
        $questions = $this->getDoctrine()->getRepository(Questions::class);
        $questions = $questions->findAll();
        return $this->render('home/index.html.twig', [
            'articles' => $article,
            'questions' => $questions,
        ]);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'ArticlesController',
        ]);
    }

    /**
     * @Route("/salle", name="salle_path")
     */
    public function salle_path(): Response
    {
        return $this->render('salle/index.html.twig');
    }
    /**
     * @Route("/article", name="article_path")
     */
    public function article_path(): Response
    {
        return $this->render('article/index.html.twig');
    }
    /**
     * @Route("/profil", name="profil")
     */
    public function profil(): Response
    {
        return $this->render('profil/index.html.twig');
    }
    
    /* 

    /**
     * @Route("/", name="home")
     * @param ArticleRepository $articleRepository
     * @return Reponse
     */
    
    /*public function home(ArticleRepository $articleRepository)
    {
        return $this->render('home/index.html.twig',[
            "articles" => $articleRepository->findBy(["published" => 1])
        ]);
    }
    */
}
