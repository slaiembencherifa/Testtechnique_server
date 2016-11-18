<?php

namespace testServerBundle\Controller;

use testServerBundle\Entity\Server;
use testServerBundle\Entity\Version;
use testServerBundle\Repository\ServerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Server controller.
 *
 * @Route("server")
 */
class ServerController extends Controller
{
    /**
     * Lists all server entities.
     *
     * @Route("/", name="server_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $servers = $em->getRepository('testServerBundle:Server')->findAll();

        return $this->render('server/index.html.twig', array(
            'servers' => $servers,
        ));
    }

    /**
     * Creates a new server entity.
     *
     * @Route("/new", name="server_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $server = new Server();
        $form = $this->createForm('testServerBundle\Form\ServerType', $server);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($server);
            $em->flush($server);

            return $this->redirectToRoute('server_index');
        }

        return $this->render('server/new.html.twig', array(
            'server' => $server,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a server entity.
     *
     * @Route("/{id}", name="server_show")
     * @Method("GET")
     */
    public function showAction(Server $server)
    {
        $deleteForm = $this->createDeleteForm($server);

        return $this->render('server/show.html.twig', array(
            'server' => $server,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing server entity.
     *
     * @Route("/{id}/edit", name="server_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Server $server)
    {
        $deleteForm = $this->createDeleteForm($server);
        $editForm = $this->createForm('testServerBundle\Form\ServerType', $server);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('server_index');
        }

        return $this->render('server/edit.html.twig', array(
            'server' => $server,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a server entity.
     *
     * @Route("/{id}", name="server_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Server $server)
    {
        $form = $this->createDeleteForm($server);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($server);
            $em->flush($server);
        }

        return $this->redirectToRoute('server_index');
    }

    /**
     * Creates a form to delete a server entity.
     *
     * @param Server $server The server entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Server $server)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('server_delete', array('id' => $server->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /*Méthode pour afficher les versions des logiciels sur un serveurs*/
    public function listversionsAction(Server $server)
    {

        $versions=$server->getVersionsimplementees();

        return $this->render('server/showversions.html.twig', array(
            'server' => $server,
            'versions' => $versions));
    }
    public function deleteVersionAction(  $id,$server){
        $em = $this->getDoctrine()->getManager();
        $version = $em->getRepository('testServerBundle:Version')->find($id);
        $serveur = $em->getRepository('testServerBundle:Server')->find($server);
        $serveur->removeVersion($version);
        $em->persist($serveur);
        $em->flush();

        return $this->render('server/showversions.html.twig', array(
            'server' => $serveur,
            'versions' => $serveur->getVersionsimplementees()));
}

}
