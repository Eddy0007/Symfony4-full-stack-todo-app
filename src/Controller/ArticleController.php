<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response("<h1>Hello and welcome to SYMPHONY</h1>");
    }
}