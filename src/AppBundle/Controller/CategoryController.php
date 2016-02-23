<?php


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    /**
     * @Route("/{category}/", name="_category")
     * @param string $category
     */
    public function indexAction($category)
    {
        $categoryHeading = "Web Development";
        $categorySubheading = "Symfony framework will be explained";
        $repository = $this->getDoctrine()->getRepository('AppBundle:Article');
        $articles = $repository->findAll();

        if ($category == "online-marketing") {
            $categoryHeading = "Online Marketing";
            $categorySubheading = "";
        } else if ($category == "management") {
            $categoryHeading = "Project Management";
            $categorySubheading = "";
        }

        if ($category === "development" || $category === "online-marketing" || $category === "management") {
            return $this->render('category/index.html.twig', array(
                'category' => $category,
                'categoryHeading' => $categoryHeading,
                'categorySubheading' => $categorySubheading,
                'articles' => $articles
            ));
        } else {
            throw $this->createNotFoundException();
        }
    }
}