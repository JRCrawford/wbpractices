<?php


namespace FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    /**
     * @Route("/{category}", name="_category")
     * @param string $category
     */
    public function indexAction($category)
    {
        if ($category === "development" || $category === "online-marketing" || $category === "management") {
            return $this->render('category/index.html.twig', array(
                'category' => $category
            ));
        } else {
            throw $this->createNotFoundException();
        }
    }
}