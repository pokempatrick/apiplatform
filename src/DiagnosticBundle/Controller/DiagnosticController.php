<?php

namespace DiagnosticBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use DiagnosticBundle\Entity\Diagnostic;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("api/diagnostic")
 */
class DiagnosticController extends FOSRestController
{
    /**
     * Create new diagnostic
     * @Post("/new", name="diagnostic_new")
     * @View(statusCode = 201, 
     * serializerGroups = {"diagnostic","result","inspectionVisuelle", 
     *       "turnRatio","isolement","transformer","internInspection" }
     * )
     * @ParamConverter("diagnostic", converter="fos_rest.request_body")
     */
    public function newAction(Diagnostic $diagnostic, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            $errors = $this->getArrayErrors($violations);
            return new JsonResponse($errors, 403);
        }
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();        
        $em->persist($diagnostic);
        $em->flush();
        return $diagnostic;
    }

    /**
     * Update existing Demande de diagnostic
     * @Put("/update/{id}", name="diagnostic_update", requirements={"id": "\d+"})
     * @View(statusCode = 200, 
     * serializerGroups = {"diagnostic","result" }
     * )
     */
    public function updateAction(Diagnostic $diagnostic, Request $request)
    {
        $data = $request->getContent();        
        $this->get('serializer')->deserialize($data , "DiagnosticBundle\Entity\Diagnostic", 'json',array('object_to_populate' => $diagnostic));
        $obj_errors = $this->get('validator')->validate($diagnostic);
        if($this->getArrayErrors($obj_errors)){
            $errors = $this->getArrayErrors($obj_errors);
            return new JsonResponse($errors, 403);
        };
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $em->flush();
        return $diagnostic;
    }

    /**
     * Deletes a diagnostic entity.
     *
     * @View(StatusCode = 204)
     * @Delete(
     *      path="/delete/{id}", 
     *      name="diagnostic_delete", 
     *      requirements={"id": "\d+"}
     * )
     */
    public function deleteAction(Diagnostic $diagnostic)
    {
        $obj_errors = $this->get('validator')->validate($diagnostic);
        if($this->getArrayErrors($obj_errors)){
            $errors = $this->getArrayErrors($obj_errors);
            return new JsonResponse($errors, 403);
        };
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $em->remove($diagnostic);
        $em->flush();
        return ;
    }

    /**
     * @Get(
     *     path = "/show/{id}",
     *     name = "diagnostic_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View(
     *      statusCode = 200,
     *      serializerGroups = {"diagnostic","result","inspectionVisuelle", 
     *       "turnRatio","isolement","transformer","internInspection", 
     *        "quality","repair", "downgrading"}
     * )
     */
    public function showAction(Diagnostic $diagnostic)
    {
        return $diagnostic;
    }

    /**
     * Lists all the diagnostic
     * @Route("/{page}", 
     *  name="diagnostic_index",
     *  defaults={"page": 1},
     *  requirements={
            "page": "\d+"
            })
     * @Method("GET")
     */
    public function indexAction($page)
    {
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $diagnostics = $em->getRepository('DiagnosticBundle:Diagnostic')
                            ->getDiagnosticIndex(10, $page);
        return $this->render('DiagnosticBundle:Diagnostic:index.html.twig', array(
            'diagnostics'   => $diagnostics,
            'page'          => $page,
            'nombrePage'    => ceil(count($diagnostics)/10),
        ));
    }

    private function getArrayErrors($obj_errors)
    {
        $errors = [];
        foreach ($obj_errors as $error) {
            if(array_key_exists($error->getPropertyPath(), $errors)) {
                $errors[$error->getPropertyPath()][] = $error->getMessage();
            } else {
                $errors[$error->getPropertyPath()] = [$error->getMessage()];
            }
        }
        return $errors;
    }

}
