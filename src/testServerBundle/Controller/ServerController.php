<?php
/**
 * Created by PhpStorm.
 * User: sloum
 * Date: 18/11/2016
 * Time: 11:44
 */

namespace testServerBundle\Controller;




use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use testServerBundle\Entity\Server;
use Symfony\Component\HttpFoundation\Request;
use testServerBundle\Form\ServerType;

class ServerController extends Controller
{
    public function addAction(Request $request){




    $form=$this->createForm(new ServerType());
    $form->handleRequest($request);
    if($request->getMethod()=='POST'){
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entityk=$form->getData();

            $em->persist($entityk);
            $em->flush();
            $em->clear();
            $form=$this->createForm(new ServerType());




            return $this->render('testServerBundle:Server:new.html.twig',array('form'=>$form->createView()));
        }}
    return $this->render('testServerBundle:Server:new.html.twig',array('form'=>$form->createView()));

}
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();
        $serveurs = $em->getRepository('testServerBundle:Server')->findAll();
        return $this->render('testServerBundle:Server:show.html.twig',array('serveurs'=>$serveurs));
    }

}