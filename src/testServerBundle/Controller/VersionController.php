<?php

namespace testServerBundle\Controller;

use testServerBundle\Entity\Server;
use testServerBundle\Entity\Version;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Version controller.
 *
 * @Route("version")
 */
class VersionController extends Controller
{
    /**
     * Lists all version entities.
     *
     * @Route("/", name="version_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $versions = $em->getRepository('testServerBundle:Version')->findAll();

        return $this->render('version/index.html.twig', array(
            'versions' => $versions,
        ));
    }
/*pour choisir une version à ajouter à un serveur */
    public function index2Action($id)
    {
        $em = $this->getDoctrine()->getManager();
        $serveur= $em->getRepository('testServerBundle:Server')->find($id);
        $versions = $em->getRepository('testServerBundle:Version')->findAll();

        return $this->render('version/index.html.twig', array(
            'versions' => $versions,'serveur'=>$serveur
        ));
    }
    /**
     * Creates a new version entity.
     *
     * @Route("/new", name="version_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $version = new Version();
        $soft=$em->getRepository('testServerBundle:Software')->find($id);
        $version->setSoftware($soft);
        $form = $this->createForm('testServerBundle\Form\VersionType', $version);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($version);
            $em->flush($version);

            return $this->redirectToRoute('software_index', array('id' => $version->getId()));
        }

        return $this->render('version/new.html.twig', array(
            'version' => $version,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a version entity.
     *
     * @Route("/{id}", name="version_show")
     * @Method("GET")
     */
    public function showAction(Version $version)
    {
        $deleteForm = $this->createDeleteForm($version);

        return $this->render('version/show.html.twig', array(
            'version' => $version,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing version entity.
     *
     * @Route("/{id}/edit", name="version_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Version $version)
    {
        $deleteForm = $this->createDeleteForm($version);
        $editForm = $this->createForm('testServerBundle\Form\VersionType', $version);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('software_index');
        }

        return $this->render('version/edit.html.twig', array(
            'version' => $version,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a version entity.
     *
     * @Route("/{id}", name="version_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Version $version)
    {
        $form = $this->createDeleteForm($version);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($version);
            $em->flush($version);
        }

        return $this->redirectToRoute('version_index');
    }

    /**
     * Creates a form to delete a version entity.
     *
     * @param Version $version The version entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Version $version)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('version_delete', array('id' => $version->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function addToServerAction(   $id,$idserveur){
        $em = $this->getDoctrine()->getManager();
        $version = $em->getRepository('testServerBundle:Version')->find($id);
        $serveur = $em->getRepository('testServerBundle:Server')->find($idserveur);
        $serveur->addVersion($version);
        return $this->redirectToRoute('server_listofversions', array('id' => $serveur->getId()))
            ;
    }
}
