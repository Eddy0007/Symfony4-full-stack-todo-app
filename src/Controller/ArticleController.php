<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class ArticleController{
    public function homepage()
    {
        return new Response("<h1>Hello and welcome to SYMPHONY</h1>");
    }
}