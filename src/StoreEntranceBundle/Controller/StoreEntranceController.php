<?php

namespace StoreEntranceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use StoreEntranceBundle\Entity\StoreEntrance;
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
 * @Route("api/storeEntrance")
 */
class StoreEntranceController extends FOSRestController
{
    /**
     * Create new storeEntrance
     * @Post("/new", name="storeEntrance_new")
     * @View(statusCode = 201, 
     * serializerGroups = {"storeEntrance","result","inspectionVisuelle", 
     *       "turnRatio","isolement","transformer" }
     * )
     * @ParamConverter("storeEntrance", converter="fos_rest.request_body")
     */
    public function newAction(StoreEntrance $storeEntrance, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            $errors = $this->getArrayErrors($violations);
            return new JsonResponse($errors, 403);
        }
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $em->persist($storeEntrance);
        $em->flush();
        return $storeEntrance;
    }

    /**
     * Update existing Demande de storeEntrance
     * @Put("/update/{id}", name="storeEntrance_update", requirements={"id": "\d+"})
     * @View(statusCode = 200, 
     * serializerGroups = {"storeEntrance","result" }
     * )
     */
    public function updateAction(StoreEntrance $storeEntrance, Request $request)
    {
        $data = $request->getContent();        
        $this->get('serializer')->deserialize($data , "StoreEntranceBundle\Entity\StoreEntrance", 'json',array('object_to_populate' => $storeEntrance));
        $obj_errors = $this->get('validator')->validate($storeEntrance);
        if($this->getArrayErrors($obj_errors)){
            $errors = $this->getArrayErrors($obj_errors);
            return new JsonResponse($errors, 403);
        };
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $em->flush();
        return $storeEntrance;
    }

    /**
     * Deletes a storeEntrance entity.
     *
     * @View(StatusCode = 204)
     * @Delete(
     *      path="/delete/{id}", 
     *      name="storeEntrance_delete", 
     *      requirements={"id": "\d+"}
     * )
     */
    public function deleteAction(StoreEntrance $storeEntrance)
    {
        $obj_errors = $this->get('validator')->validate($storeEntrance);
        if($this->getArrayErrors($obj_errors)){
            $errors = $this->getArrayErrors($obj_errors);
            return new JsonResponse($errors, 403);
        };
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $em->remove($storeEntrance);
        $em->flush();
        return ;
    }

    /**
     * @Get(
     *     path = "/show/{id}",
     *     name = "storeEntrance_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View(
     *     statusCode = 200,
     *     serializerGroups = {"storeEntrance","result","inspectionVisuelle", 
     *       "turnRatio","isolement","transformer","internInspection"}
     * )
     */
    public function showAction(StoreEntrance $storeEntrance)
    {
        return $storeEntrance;
    }

     /**
     * Lists all the storeEntrance
     * @Get(
     *      path= "/{page}", 
     *      name="storeEntrance_index",
     *      defaults={"page": 1},
     *      requirements={"page": "\d+"}
     * )
     * @View(
     *     statusCode = 200,
     *     serializerGroups = {"storeEntrance"}
     * )
     */
    public function indexAction($page)
    {
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $transformers = $em->getRepository('StoreEntranceBundle:StoreEntrance')
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
