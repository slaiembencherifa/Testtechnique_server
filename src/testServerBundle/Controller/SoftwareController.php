<?php
/**
 * Created by PhpStorm.
 * User: sloum
 * Date: 18/11/2016
 * Time: 13:22
 */

namespace testServerBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SoftwareController extends Controller
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




                return $this->render('testserverBundle:Software:new.html.twig',array('form'=>$form->createView()));
            }}
        return $this->render('CompanyBundle:Software:new.html.twig',array('form'=>$form->createView()));

    }
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();
        $softwares = $em->getRepository('CompanyBundle:Software')->findAll();
        return $this->render('CompanyBundle:Software:show.html.twig',array('softwares'=>$softwares));
    }


}