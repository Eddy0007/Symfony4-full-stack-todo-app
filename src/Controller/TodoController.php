<?php
namespace App\Controller;

use App\Entity\Todo;
//use Doctrine\DBAL\Types\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * @Route("/todo/new", name="new_todo")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request)
    {
//        creates a todo and gives it some dummy data for.
        $todo = new Todo();
//        $todo->setTitle('Do something');
//        $todo->setBody('Something is being done');

        $form = $this->createFormBuilder($todo)
            ->add('title', TextType::class, array('attr' => array('required')))
            ->add('body', TextType::class, array('attr' => array('required')))
            ->add('save', SubmitType::class, array(
                'label'=>'Create Todo',
                'attr'=>array('class' => 'button')
                ))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $todo = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($todo);
            $entityManager->flush();

            return $this->redirectToRoute('todo_list');
        }
        return $this->render('todos/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/todo/edit/{id}", name="edit_todo")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, $id)
    {
        $todo = new Todo();
        $todo = $this->getDoctrine()->getRepository(Todo::class)->find($id);

        $form = $this->createFormBuilder($todo)
            ->add('title', TextType::class, array('attr' => array('required')))
            ->add('body', TextType::class, array('attr' => array('required')))
            ->add('save', SubmitType::class, array(
                'label'=>'Update Todo',
                'attr'=>array('class' => 'button')
            ))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('todo_list');
        }
        return $this->render('todos/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/todo/{id}", name = "todo_show")
     */
    public function show($id)
    {
        $todo = $this->getDoctrine()->getRepository(Todo::class)->find($id);
        return $this->render('todos/show.html.twig', array('todo' => $todo));
    }

    /**
     * @Route("/todo/delete/{id}")
     * @method({"DELETE"})
     */
    public function  delete(Request $request, $id)
    {
        $todo = $this->getDoctrine()->getRepository(Todo::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($todo);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }
}