<?php

namespace DowngradingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationList;
use DowngradingBundle\Entity\Downgrading;
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
 * @Route("api/downgrading")
 */
class DowngradingController extends FOSRestController
{
    /**
     * Create new downgrading
     * @Post("/new", name="downgrading_new")
     * @View(statusCode = 201, 
     * serializerGroups = {"downgrading","sparePart"}
     * )
     * @ParamConverter("downgrading", converter="fos_rest.request_body")
     */
    public function newAction(Downgrading $downgrading, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            $errors = $this->getArrayErrors($violations);
            return new JsonResponse($errors, 403);
        }
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $em->persist($downgrading);
        $em->flush();
        return $downgrading;
    }

    /**
     * Update existing Demande de downgrading
     * @Put("/update/{id}", name="downgrading_update", requirements={"id": "\d+"})
     * @View(statusCode = 200, 
     * serializerGroups = {"downgrading","sparePart"}
     * )
     */
    public function updateAction(Downgrading $downgrading, Request $request)
    {
        $data = $request->getContent();        
        $this->get('serializer')->deserialize($data , "DowngradingBundle\Entity\Downgrading", 'json',array('object_to_populate' => $downgrading));
        $obj_errors = $this->get('validator')->validate($downgrading);
        if($this->getArrayErrors($obj_errors)){
            $errors = $this->getArrayErrors($obj_errors);
            return new JsonResponse($errors, 403);
        };
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $em->flush();
        return $downgrading;
    }

    /**
     * Deletes a downgrading entity.
     *
     * @View(StatusCode = 204)
     * @Delete(
     *      path="/delete/{id}", 
     *      name="downgrading_delete", 
     *      requirements={"id": "\d+"}
     * )
     */
    public function deleteAction(Downgrading $downgrading)
    {
        $obj_errors = $this->get('validator')->validate($downgrading);
        if($this->getArrayErrors($obj_errors)){
            $errors = $this->getArrayErrors($obj_errors);
            return new JsonResponse($errors, 403);
        };
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $em->remove($downgrading);
        $em->flush();
        return ;
    }

    /**
     * @Get(
     *     path = "/show/{id}",
     *     name = "downgrading_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View(
     *     statusCode = 200,
     *     serializerGroups = {"downgrading"}
     * )
     */
    public function showAction(Downgrading $downgrading)
    {
        return $downgrading;
    }

     /**
     * Lists all the downgrading
     * @Get(
     *      path= "/{page}", 
     *      name="downgrading_index",
     *      defaults={"page": 1},
     *      requirements={"page": "\d+"}
     * )
     * @View(
     *     statusCode = 200,
     *     serializerGroups = {"downgrading"}
     * )
     */
    public function indexAction($page)
    {
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $transformers = $em->getRepository('DowngradingBundle:Downgrading')
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
