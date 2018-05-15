<?php
namespace App\Controller;

use App\Entity\Todo;
//use Doctrine\DBAL\Types\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/form")
     */
    public function new(Request $request)
    {
//        creates a todo and gives it some dummy data for.
        $todo = new Todo();
        $todo->setTitle('Do something');
        $todo->setBody('Something is being done');

        $form = $this->createFormBuilder($todo)
            ->add('title', TextType::class)
            ->add('body', TextType::class)
            ->add('save', SubmitType::class, array('label'=>'Create Todo'))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $todo = $form->getData();
            return $this->redirectToRoute('todo_success');
        }
        return $this->render('todos/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}