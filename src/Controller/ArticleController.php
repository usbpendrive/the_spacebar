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
        $comments = [
            'Drain pork shoulder fairly, then mix with cream and serve freshly in sauté pan.',
            'All children like sliced raspberries in buttermilk and thyme.',
            'Per guest prepare eight pounds of salad cream with shreded seaweed for dessert.'
        ];

        //dump($slug, $this);

        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments,
        ]);
    }
}