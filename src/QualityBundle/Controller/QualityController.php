<?php

namespace QualityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationList;
use QualityBundle\Entity\Quality;
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
 * @Route("api/quality")
 */
class QualityController extends FOSRestController
{
    /**
     * Create new quality
     * @Post("/new", name="quality_new")
     * @View(statusCode = 201, 
     * serializerGroups = {"quality","result","inspectionVisuelle", 
     *       "turnRatio","isolement","transformer" }
     * )
     * @ParamConverter("quality", converter="fos_rest.request_body")
     */
    public function newAction(Quality $quality, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            $errors = $this->getArrayErrors($violations);
            return new JsonResponse($errors, 403);
        }
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $em->persist($quality);
        $em->flush();
        return $quality;
    }

    /**
     * Update existing Demande de quality
     * @Put("/update/{id}", name="quality_update", requirements={"id": "\d+"})
     * @View(statusCode = 200, 
     * serializerGroups = {"quality","result","inspectionVisuelle", 
     *       "turnRatio","isolement","transformer" }
     * )
     */
    public function updateAction(Quality $quality, Request $request)
    {
        $data = $request->getContent();        
        $this->get('serializer')->deserialize($data , "QualityBundle\Entity\Quality", 'json',array('object_to_populate' => $quality));
        $obj_errors = $this->get('validator')->validate($quality);
        if($this->getArrayErrors($obj_errors)){
            $errors = $this->getArrayErrors($obj_errors);
            return new JsonResponse($errors, 403);
        };
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $em->flush();
        return $quality;
    }

    /**
     * Deletes a quality entity.
     *
     * @View(StatusCode = 204)
     * @Delete(
     *      path="/delete/{id}", 
     *      name="quality_delete", 
     *      requirements={"id": "\d+"}
     * )
     */
    public function deleteAction(Quality $quality)
    {
        $obj_errors = $this->get('validator')->validate($quality);
        if($this->getArrayErrors($obj_errors)){
            $errors = $this->getArrayErrors($obj_errors);
            return new JsonResponse($errors, 403);
        };
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $em->remove($quality);
        $em->flush();
        return ;
    }

    /**
     * @Get(
     *     path = "/show/{id}",
     *     name = "quality_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View(
     *     statusCode = 200,
     *     serializerGroups = {"quality"}
     * )
     */
    public function showAction(Quality $quality)
    {
        return $quality;
    }

     /**
     * Lists all the quality
     * @Get(
     *      path= "/{page}", 
     *      name="quality_index",
     *      defaults={"page": 1},
     *      requirements={"page": "\d+"}
     * )
     * @View(
     *     statusCode = 200,
     *     serializerGroups = {"quality"}
     * )
     */
    public function indexAction($page)
    {
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $transformers = $em->getRepository('QualityBundle:Quality')
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
