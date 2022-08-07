<?php

namespace DiagnosticBundle\Controller;

use DiagnosticBundle\Entity\Manufacturer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * Parameter controller.
 *
 * @Route("api/parameters")
 */
class ParameterController extends FOSRestController
{
    /**
     * Lists all the manufacturer
     * @Route(
     *      path= "/manufacturer", 
     *      name="manufacturer_api_index",
     * )
      * @View(
     *     statusCode = 200,
     *     serializerGroups = {"manufacturer"}
     * )
     */
    public function manufacturerAction()
    {
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $manufacturers = $em->getRepository('DiagnosticBundle:Manufacturer')
                            ->findAll();
        foreach ($manufacturers as $value) {
            $manufacturer[] = $value->getNom();
        }
        return $manufacturer;
    }

    /**
     * Index diagnostic
     * @Route(
     *      path= "/diagnostic/{name}", 
     *      name="diagnostic_api_index",
     *      requirements={"name": "\d{4,8}"}
     * )
      * @View(
     *     statusCode = 200,
     *     serializerGroups = {"diagnostic","result","inspectionVisuelle", 
     *       "turnRatio","isolement","transformer","internInspection" }
     * )
     */
    public function diagnosticAction($name)
    {
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $entities = $em->getRepository('DiagnosticBundle:Diagnostic')
                            ->findDiagnosticSerialOrMatricule($name);
        return $entities;
    }
    /**
     * Index quality
     * @Route(
     *      path= "/quality/{name}", 
     *      name="quality_api_index",
     *      requirements={"name": "\d{4,8}"}
     * )
      * @View(
     *     statusCode = 200,
     *     serializerGroups = {"quality","result","inspectionVisuelle", 
     *       "turnRatio","isolement","transformer" }
     * )
     */
    public function qualityAction($name)
    {
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $entities = $em->getRepository('DiagnosticBundle:Diagnostic')
                            ->findQualitySerialOrMatricule($name);
        return $entities;
    }
    /**
     * Index repairs
     * @Route(
     *      path= "/repair/{name}", 
     *      name="repair_api_index",
     *      requirements={"name": "\d{4,8}"}
     * )
      * @View(
     *     statusCode = 200,
     *     serializerGroups = {"repair","transformer","sparePart"}
     * )
     */
    public function repairAction($name)
    {
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $entities = $em->getRepository('DiagnosticBundle:Diagnostic')
                            ->findRepairSerialOrMatricule($name);
        return $entities;
    }
    /**
     * Index downgradings
     * @Route(
     *      path= "/downgrading/{name}", 
     *      name="downgrading_api_index",
     *      requirements={"name": "\d{4,8}"}
     * )
      * @View(
     *     statusCode = 200,
     *     serializerGroups = {"repair","transformer","sparePart" }
     * )
     */
    public function downgradingAction($name)
    {
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $entities = $em->getRepository('DiagnosticBundle:Diagnostic')
                            ->findDowngradingSerialOrMatricule($name);
        return $entities;
    }
    /**
     * Index thirdPartys
     * @Route(
     *      path= "/thirdParty/{name}", 
     *      name="thirdParty_api_index",
     *      requirements={"name": "\d{4,8}"}
     * )
      * @View(
     *     statusCode = 200,
     *     serializerGroups = {"thirdParty","result","inspectionVisuelle", 
     *       "turnRatio","isolement","transformer" }
     * )
     */
    public function thirdPartyAction($name)
    {
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $entities = $em->getRepository('DiagnosticBundle:Diagnostic')
                            ->findThirdPartySerialOrMatricule($name);
        return $entities;
    }
    /**
     * Index storeEntrances
     * @Route(
     *      path= "/storeEntrance/{name}", 
     *      name="storeEntrance_api_index",
     *      requirements={"name": "\d{4,8}"}
     * )
      * @View(
     *     statusCode = 200,
     *     serializerGroups = {"storeEntrance","result","inspectionVisuelle", 
     *       "turnRatio","isolement","transformer" }
     * )
     */
    public function storeEntranceAction($name)
    {
        $em = $this->container->get('eneo_notification.databaseprovider')->EntityManager();
        $entities = $em->getRepository('DiagnosticBundle:Diagnostic')
                            ->findStoreEntranceSerialOrMatricule($name);
        return $entities;
    }

}
