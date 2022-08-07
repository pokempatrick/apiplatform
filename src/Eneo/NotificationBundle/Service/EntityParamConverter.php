<?php
// src/Eneo/NotificationBundle/Service/EntityParamConverter.php
namespace Eneo\NotificationBundle\Service;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Eneo\NotificationBundle\Service\DatabaseProvider;
use Doctrine\Bundle\DoctrineBundle\Registry;

/**
* Service de conversion des paramètres des requètes choix de l'entity Manager.
**
@author Pokem Ladzou email: pokempatrick@yahoo.fr
*/
class EntityParamConverter implements ParamConverterInterface
{
	private $dbProvider;
	private $doctrine;

	public function __construct(DatabaseProvider $dbProvider, Registry $doctrine)
	{
		$this->doctrine 	= $doctrine;
		$this->dbProvider 	= $dbProvider;
	}

	function supports(ParamConverter $configuration)
	{
		return ! $this->doctrine->getManager()->getMetadataFactory()->isTransient($configuration->getClass());
	} 

	function apply(Request $request, ParamConverter $configuration)
	{
		$em = $this->dbProvider->EntityManager();
		$repository=$em->getRepository($configuration->getClass());
		if(!empty($configuration->getOptions()["mapping"])){
			$id=array_keys($configuration->getOptions()["mapping"])[0];
		} else{
			$id ='id';
		}
		$entity = $repository->findOneById($request->attributes->get($id));
		if($entity === null)
		{
			throw new NotFoundHttpException($configuration->getClass().' id = '.$request->attributes->get($id).' object not found.');
		}
		$request->attributes->set($configuration->getName(), $entity);
		return true;

	}
}