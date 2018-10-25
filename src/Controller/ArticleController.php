<?php
/**
 * Created by PhpStorm.
 * User: Fernando
 * Date: 24/10/2018
 * Time: 14.54
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @return Response
     * @Route("/")
     */
    public function homepage()
    {
        return new Response("Symfony 4 Homepage");
    }

    /**
     * @Route("/news/{slug}")
     * @param $slug
     * @return Response
     */
    public function show($slug)
    {
        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug))
        ]);
    }
}