<?php

namespace testServerBundle\Controller;

use testServerBundle\Entity\Software;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Software controller.
 *
 * @Route("software")
 */
class SoftwareController extends Controller
{
    /**
     * Lists all software entities.
     *
     * @Route("/", name="software_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $softwares = $em->getRepository('testServerBundle:Software')->findAll();

        return $this->render('software/index.html.twig', array(
            'softwares' => $softwares,
        ));
    }

    /**
     * Creates a new software entity.
     *
     * @Route("/new", name="software_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $software = new Software();
        $form = $this->createForm('testServerBundle\Form\SoftwareType', $software);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($software);
            $em->flush($software);

            return $this->redirectToRoute('software_show', array('id' => $software->getId()));
        }

        return $this->render('software/new.html.twig', array(
            'software' => $software,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a software entity.
     *
     * @Route("/{id}", name="software_show")
     * @Method("GET")
     */
    public function showAction(Software $software)
    {
        $deleteForm = $this->createDeleteForm($software);

        return $this->render('software/show.html.twig', array(
            'software' => $software,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing software entity.
     *
     * @Route("/{id}/edit", name="software_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Software $software)
    {
        $deleteForm = $this->createDeleteForm($software);
        $editForm = $this->createForm('testServerBundle\Form\SoftwareType', $software);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('software_edit', array('id' => $software->getId()));
        }

        return $this->render('software/edit.html.twig', array(
            'software' => $software,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a software entity.
     *
     * @Route("/{id}", name="software_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Software $software)
    {
        $form = $this->createDeleteForm($software);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($software);
            $em->flush($software);
        }

        return $this->redirectToRoute('software_index');
    }

    /**
     * Creates a form to delete a software entity.
     *
     * @param Software $software The software entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Software $software)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('software_delete', array('id' => $software->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
/*lister les versions d'un logiciel*/
    public function listversionsAction(Software $software)
    {
        $em = $this->getDoctrine()->getManager();
        $versions = $em->getRepository('testServerBundle:Version')->findBySoftware($software);

        return $this->render('software/showversions.html.twig', array(
            'software' => $software,
            'versions' => $versions));
    }
}
