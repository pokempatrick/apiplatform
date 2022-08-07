<?php

namespace ThirdPartyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationList;
use ThirdPartyBundle\Entity\ThirdParty;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Request\ParamFetcherInterface;



/**
 *
 * @Route("api/thirdParty")
 */
class ThirdPartyController extends FOSRestController
{
    /**
     * Create new thirdParty
     * @Post("/new", name="thirdParty_new")
     * @View(statusCode = 201, 
     * serializerGroups = {"thirdParty","result","inspectionVisuelle", 
     *       "turnRatio","isolement","transformer" }
     * )
     * @ParamConverter("thirdParty", converter="fos_rest.request_body")
     */
    public function newAction(ThirdParty $thirdParty, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            $errors = $this->getArrayErrors($violations);
            return new JsonResponse($errors, 403);
        }
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $em->persist($thirdParty);
        $em->flush();
        return $thirdParty;
    }

    /**
     * Update existing Demande de thirdParty
     * @Put("/update/{id}", name="thirdParty_update", requirements={"id": "\d+"})
     * @View(statusCode = 200, 
     * serializerGroups = {"thirdParty","result","inspectionVisuelle", 
     *       "turnRatio","isolement","transformer" }
     * )
     */
    public function updateAction(ThirdParty $thirdParty, Request $request)
    {
        $data = $request->getContent();        
        $this->get('serializer')->deserialize($data , "ThirdPartyBundle\Entity\ThirdParty", 'json',array('object_to_populate' => $thirdParty));
        $obj_errors = $this->get('validator')->validate($thirdParty);
        if($this->getArrayErrors($obj_errors)){
            $errors = $this->getArrayErrors($obj_errors);
            return new JsonResponse($errors, 403);
        };
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $em->flush();
        return $thirdParty;
    }

    /**
     * Deletes a thirdParty entity.
     *
     * @View(StatusCode = 204)
     * @Delete(
     *      path="/delete/{id}", 
     *      name="thirdParty_delete", 
     *      requirements={"id": "\d+"}
     * )
     */
    public function deleteAction(ThirdParty $thirdParty)
    {
        $obj_errors = $this->get('validator')->validate($thirdParty);
        if($this->getArrayErrors($obj_errors)){
            $errors = $this->getArrayErrors($obj_errors);
            return new JsonResponse($errors, 403);
        };
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $em->remove($thirdParty);
        $em->flush();
        return ;
    }

    /**
     * @Get(
     *     path = "/show/{id}",
     *     name = "thirdParty_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View(
     *     statusCode = 200,
     *     serializerGroups = {"thirdParty","result","inspectionVisuelle", 
     *       "turnRatio","isolement","transformer","internInspection"}
     * )
     */
    public function showAction(ThirdParty $thirdParty)
    {
        return $thirdParty;
    }

     /**
     * Lists all the thirdParty
     * @Get(
     *      path= "/{page}", 
     *      name="thirdParty_index",
     *      defaults={"page": 1},
     *      requirements={"page": "\d+"}
     * )
     * @View(
     *     statusCode = 200,
     *     serializerGroups = {"thirdParty"}
     * )
     */
    public function indexAction($page)
    {
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $transformers = $em->getRepository('ThirdPartyBundle:ThirdParty')
                            ->findAll();
        return $transformers;
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
