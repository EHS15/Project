<?php

namespace NewsletterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/newsletter", name="newsletter")
     */
    public function indexAction()
    {
        return $this->render('NewsletterBundle:Default:index.html.twig');
    }
}