<?php

namespace DiagnosticBundle\Controller;

use DiagnosticBundle\Entity\Transformer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Transformer controller.
 *
 * @Route("manage/transformer")
 */
class TransformerController extends Controller
{
    /**
     * Lists all transformer entities.
     *
     * @Route("/", name="transformer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $transformers = $em->getRepository('DiagnosticBundle:Transformer')->findAll();

        return $this->render('transformer/index.html.twig', array(
            'transformers' => $transformers,
        ));
    }

    /**
     * Creates a new transformer entity.
     *
     * @Route("/new", name="transformer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $transformer = new Transformer();
        $form = $this->createForm('DiagnosticBundle\Form\TransformerType', $transformer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($transformer);
            $em->flush();

            return $this->redirectToRoute('transformer_show', array('id' => $transformer->getId()));
        }

        return $this->render('transformer/new.html.twig', array(
            'transformer' => $transformer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a transformer entity.
     *
     * @Route("/{id}", name="transformer_show")
     * @Method("GET")
     */
    public function showAction(Transformer $transformer)
    {
        $deleteForm = $this->createDeleteForm($transformer);

        return $this->render('transformer/show.html.twig', array(
            'transformer' => $transformer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing transformer entity.
     *
     * @Route("/{id}/edit", name="transformer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Transformer $transformer)
    {
        $deleteForm = $this->createDeleteForm($transformer);
        $editForm = $this->createForm('DiagnosticBundle\Form\TransformerType', $transformer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('transformer_edit', array('id' => $transformer->getId()));
        }

        return $this->render('transformer/edit.html.twig', array(
            'transformer' => $transformer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a transformer entity.
     *
     * @Route("/{id}", name="transformer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Transformer $transformer)
    {
        $form = $this->createDeleteForm($transformer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($transformer);
            $em->flush();
        }

        return $this->redirectToRoute('transformer_index');
    }

    /**
     * Creates a form to delete a transformer entity.
     *
     * @param Transformer $transformer The transformer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Transformer $transformer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('transformer_delete', array('id' => $transformer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
