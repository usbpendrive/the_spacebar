<?php
/**
 * Created by PhpStorm.
 * User: Fernando
 * Date: 24/10/2018
 * Time: 14.54
 */

namespace App\Controller;


use App\Service\MarkdownHelper;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @return Response
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     * @param $slug
     * @param MarkdownHelper $markdownHelper
     * @return Response
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function show($slug, MarkdownHelper $markdownHelper)
    {
        $comments = [
            'Drain pork shoulder fairly, then mix with cream and serve freshly in sauté pan.',
            'All children like sliced raspberries in buttermilk and thyme.',
            'Per guest prepare eight pounds of salad cream with shreded seaweed for dessert.'
        ];

        $articleContent = <<<EOF
Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
turkey shank eu pork belly meatball non cupim.
Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
occaecat lorem meatball prosciutto quis strip steak.
Meatball adipisicing ribeye bacon strip steak eu. **Consectetur** ham hock pork hamburger enim strip steak
mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
fugiat.
EOF;
        /*
        $item = $cache->getItem('markdown_'.md5($articleContent));
        if (!$item->isHit()) {
            $item->set($markdown->transform($articleContent));
            $cache->save($item);
        }
        #dump($cache);die;

        $articleContent = $item->get();*/
        $articleContent = $markdownHelper->parse($articleContent);
        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments,
            'articleContent' => $articleContent,
            'slug' => $slug
        ]);
    }

    /**
     * @param $slug
     * @param LoggerInterface $logger
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     * @return JsonResponse
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        $logger->info('Article is being hearted');
        return $this->json(['hearts' => rand(5, 100)]);
    }
}