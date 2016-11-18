<?php
/**
 * Created by PhpStorm.
 * User: sloum
 * Date: 18/11/2016
 * Time: 11:44
 */

namespace testServerBundle\Controller;




use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use test\serverBundle\Entity\Server;

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




                return $this->render('testserverBundle:Server:new.html.twig',array('form'=>$form->createView()));
            }}
        return $this->render('CompanyBundle:Server:new.html.twig',array('form'=>$form->createView()));

    }
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $serveurs = $em->getRepository('CompanyBundle:Server')->findAll();
        return $this->render('CompanyBundle:Server:show.html.twig',array('serveurs'=>$serveurs));
    }

}