<?php

namespace DiagnosticBundle\Controller;

use DiagnosticBundle\Entity\Manufacturer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;

/**
 * Manufacturer controller.
 *
 * @Route("manage/manufacturer")
 */
class ManufacturerController extends Controller
{
    /**
     * Lists all manufacturer entities.
     *
     * @Route("/", name="manufacturer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $manufacturers = $em->getRepository('DiagnosticBundle:Manufacturer')->findAll();

        return $this->render('manufacturer/index.html.twig', array(
            'manufacturers' => $manufacturers,
        ));
    }

    /**
     * Creates a new manufacturer entity.
     *
     * @Route("/new", name="manufacturer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $manufacturer = new Manufacturer();
        $form = $this->createForm('DiagnosticBundle\Form\ManufacturerType', $manufacturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($manufacturer);
            $em->flush();

            return $this->redirectToRoute('manufacturer_show', array('id' => $manufacturer->getId()));
        }

        return $this->render('manufacturer/new.html.twig', array(
            'manufacturer' => $manufacturer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a manufacturer entity.
     *
     * @Route("/{id}", name="manufacturer_show")
     * @Method("GET")
     */
    public function showAction(Manufacturer $manufacturer)
    {
        $deleteForm = $this->createDeleteForm($manufacturer);

        return $this->render('manufacturer/show.html.twig', array(
            'manufacturer' => $manufacturer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing manufacturer entity.
     *
     * @Route("/{id}/edit", name="manufacturer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Manufacturer $manufacturer)
    {
        $deleteForm = $this->createDeleteForm($manufacturer);
        $editForm = $this->createForm('DiagnosticBundle\Form\ManufacturerType', $manufacturer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('manufacturer_edit', array('id' => $manufacturer->getId()));
        }

        return $this->render('manufacturer/edit.html.twig', array(
            'manufacturer' => $manufacturer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a manufacturer entity.
     *
     * @Route("/{id}", name="manufacturer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Manufacturer $manufacturer)
    {
        $form = $this->createDeleteForm($manufacturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($manufacturer);
            $em->flush();
        }

        return $this->redirectToRoute('manufacturer_index');
    }


    /**
     * Creates a form to delete a manufacturer entity.
     *
     * @param Manufacturer $manufacturer The manufacturer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Manufacturer $manufacturer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('manufacturer_delete', array('id' => $manufacturer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    /**
     * Lists all the diagnostic
     * @Get(
     *      path= "/api/index", 
     *      name="manufacturer_api_index",
     * )
     * @View(
     *     statusCode = 200,
     *     serializerGroups = {"manufacturer"}
     * )
     */
    public function indexApiAction()
    {
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $manufacturers = $em->getRepository('DiagnosticBundle:Manufacturer')
                            ->findAll();
        return $manufacturers;
    }
}
