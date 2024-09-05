<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class MonController extends AbstractController
{
    /**
     * @Route("/hello", name="hello_world")
     */
    public function hello()
    {
        return new Response("hello world");
    }
}