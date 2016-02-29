<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ArticleController extends Controller
{
    /**
     * @Route("/{category}/{article_slug}",
     *      requirements={"category": "development|online-marketing|management"},
     *      name="_article")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($article_slug)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Article');
        $query = $repository->createQueryBuilder('a')
                ->where('a.slug = :slug')
                ->setParameter('slug', $article_slug)
            ->getQuery();
        $article = $query->getOneOrNullResult();

        return $this->render('article/index.html.twig', array(
            'article' => $article,
        ));
    }

    /**
     * @Route("/article/new", name="_newArticle")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        // 1) build the form
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            // ... do any other work - like send them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('_newArticle');
        }

        return $this->render(
            'article/new_update.html.twig',
            array('form' => $form->createView())
        );

    }
}