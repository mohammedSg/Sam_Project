<?php

namespace SamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/{page}", defaults={"page" = 12}, requirements={
     *          "page": "\d+"
     * })
     */
    public function indexAction($page)
    {
        return $this->render('SamBundle:Default:index.html.twig');
    }
}
