<?php
namespace App\Controller;

use App\Entity\Todo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends Controller {
    /**
     * @Route("/", name = "todo_list")
     */
    public function homepage()
    {
//        return new Response("<h1>Hello and welcome to SYMPHONY</h1>");
//        $todos = ['Activity 1', 'Activity 2', 'Activity 3', 'Activity 4','Activity 5', 'Activity 6'];
        $todos = $this->getDoctrine()->getRepository(Todo::class)->findAll();
        return $this->render('todos/index.html.twig', array('todos'=>$todos));
    }

    /**
     * @Route("/todo/{id}", name = "todo_show")
     */
    public function show($id)
    {
        $todo = $this->getDoctrine()->getRepository(Todo::class)->find($id);
        return $this->render('todos/show.html.twig', array('todo' => $todo));
    }

//    Adding data to the database using a url: Not recommended.
//    /**
//     * @Route("/todo/save")
//     */
//    public function save()
//    {
//        $entityManager = $this -> getDoctrine() -> getManager();
//
//        $todo = new Todo();
//        $todo->setTitle('Title Two');
//        $todo->setBody('This is the body for todo two');
//
//        $entityManager->persist($todo);
//
//        $entityManager->flush();
//
//        return new Response('Saved a todo with the id of '.$todo->getId());
//    }
}