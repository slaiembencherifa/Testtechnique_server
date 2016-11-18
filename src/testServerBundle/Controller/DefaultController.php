<?php

namespace testServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em= $this->getDoctrine()->getManager();
        $serveurs=$em->getRepository('testServerBundle:Server')->findAll();
        $softwares=$em->getRepository('testServerBundle:Software')->findAll();


        return $this->render('testServerBundle:Default:index.html.twig',array('servers'=>$serveurs,'softwares'=>$softwares));
    }
}
