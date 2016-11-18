<?php
/**
 * Created by PhpStorm.
 * User: sloum
 * Date: 18/11/2016
 * Time: 13:26
 */

namespace testServerBundle\Controller;


class VersionController
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




                return $this->render('testServerBundle:Version:new.html.twig',array('form'=>$form->createView()));
            }}
        return $this->render('testServerBundle:Version:new.html.twig',array('form'=>$form->createView()));

    }
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();
        $versions = $em->getRepository('CompanyBundle:Version')->findAll();
        return $this->render('testServerBundle:Version:show.html.twig',array('versions'=>$versions));
    }
}