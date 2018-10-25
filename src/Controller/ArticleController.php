<?php
/**
 * Created by PhpStorm.
 * User: Fernando
 * Date: 24/10/2018
 * Time: 14.54
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController
{
    /**
     * @return Response
     * @Route("/")
     */
    public function homepage()
    {
        return new Response("Symfony 4 Homepage");
    }
}