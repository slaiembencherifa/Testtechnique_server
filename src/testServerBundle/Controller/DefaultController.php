<?php

namespace testServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('testServerBundle:Default:index.html.twig');
    }
}
