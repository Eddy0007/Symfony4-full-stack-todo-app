<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends Controller {
    /**
     * @Route("/")
     */
    public function homepage()
    {
//        return new Response("<h1>Hello and welcome to SYMPHONY</h1>");
        return $this->render('todos/index.html.twig');
    }
}