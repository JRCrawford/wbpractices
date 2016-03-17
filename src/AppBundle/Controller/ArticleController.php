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
     * @Route("/article/edit/{id}", defaults={"id" = null}, name="_editArticle")
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function newAction(Request $request, $id = null)
    {
        //1) See if article exists and pull out it data if it does
        if ($id) {
            $article = $this->getDoctrine()->getRepository('AppBundle:Article')->find($id);
            if (!$article instanceof Article) {
                $article = new Article();
            }
        } else {
            $article = new Article();
        }

        // 2) build the form
        $form = $this->createForm(ArticleType::class, $article);

        // 3) handle the submit (will only happen on POST)
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // 4) save/update the article
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();

                $this->addFlash(
                    'notice',
                    'Article changes were saved'
                );

                return $this->redirectToRoute('_editArticle', ['id' => $article->getId()]);
            }
        }

        return $this->render(
            'article/new_update.html.twig',
            array('form' => $form->createView())
        );
    }
}