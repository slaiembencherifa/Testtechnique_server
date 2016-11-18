<?php
/**
 * Created by PhpStorm.
 * User: sloum
 * Date: 18/11/2016
 * Time: 13:22
 */

namespace testServerBundle\Controller;


class SoftwareController
{
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $serveurs = $em->getRepository('CompanyBundle:Sprint')->findAll();
        return $this->render('CompanyBundle:Server:show.html.twig',array('serveurs'=>$serveurs));
    }
}