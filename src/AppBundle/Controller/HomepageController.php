<?php


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    /**
     * @Route("/", name="_homepage")
     */
    public function indexAction()
    {
        //http://shapebootstrap.net/demo/html/corlate/

        return $this->render('homepage/index.html.twig');
    }

}