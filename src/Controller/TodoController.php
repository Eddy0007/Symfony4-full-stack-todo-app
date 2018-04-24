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
        $todos = ['Activity 1', 'Activity 2', 'Activity 3', 'Activity 4','Activity 5', 'Activity 6'];
        return $this->render('todos/index.html.twig', array('todos'=>$todos));
    }
}