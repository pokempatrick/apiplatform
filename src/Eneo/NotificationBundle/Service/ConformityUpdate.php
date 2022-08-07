<?php
 
// src/Eneo/NotificationBundle/Service/ConformityUpdate.php
namespace Eneo\NotificationBundle\Service;
use Eneo\NotificationBundle\Service\DatabaseProvider;


/**
* Service d'enregistrement des opérateurs courants.
**
@author Pokem Ladzou email: pokempatrick@yahoo.fr
*/
class ConformityUpdate
{
	private $dbProvider;

	public function __construct(DatabaseProvider $dbProvider)
	{
		$this->dbProvider 	= $dbProvider;
	}
	// contrôle conformité transformateur diagnostic
	public function conformityDiagnostic($entity)
	{
		$transformer = $entity->getTransformer();
		$entity->setConformity(true);
		$em = $this->dbProvider->EntityManager();
		$exist_transformer = $em->getRepository('DiagnosticBundle:Transformer')
                                    ->findOneBy(array(
                                            'serie'=>$transformer->getSerie(),
                                            'manufacturer'=>$transformer->getManufacturer(),
                                        ));
		if($exist_transformer !== null){
            $entity->setTransformer($exist_transformer);
	        if ($exist_transformer->getMatricule() !== $transformer->getMatricule()) 
	        {
	            $entity->setConformity(false);
	            $entity->setStatut(true);
	            $result = $entity->getResult();
	            $result->setAnomalie($result->getAnomalie()." Numéro d'immatriculation Non conforme ".$transformer->getMatricule());
	            $entity->setResult($result);
	        }
        } 
	}
	public function conformityNewTransformer($entity)
	{
		$transformer = $entity->getTransformer();
		$entity->setConformity(true);
		$em = $this->dbProvider->EntityManager();
		$exist_transfo = $em->getRepository('DiagnosticBundle:Transformer')
                            ->findOneBy(array(
                                    'serie'=>$transformer->getSerie(),
                                    'manufacturer'=>$transformer->getManufacturer(),
                                ));
        $exist_matricule = $em->getRepository('DiagnosticBundle:Transformer')
                                ->findOneByMatricule($transformer->getMatricule());
		if($exist_transfo!==null){
            $entity->setConformity(false);
            $entity->setStatut(true);
            $result = $entity->getResult();
            $result->setAnomalie($result->getAnomalie()." Numéro de série existant ".
            	$transformer->getSerie());
            $entity->setTransformer($exist_transfo);
        }
        if($exist_matricule->getMatricule()!==null){
            $entity->setConformity(false);
            $entity->setStatut(true);
            $result = $entity->getResult();
            $result->setAnomalie($result->getAnomalie()." Numéro d'immatriculation existant ".
            	$transformer->getMatricule());
            $entity->setTransformer($exist_matricule);
        }
	}
	public function conformityQuality($entity)
	{
		$transformer = $entity->getTransformer();
		$entity->setConformity(true);
		$em = $this->dbProvider->EntityManager();
		$exist_transformer = $em->getRepository('DiagnosticBundle:Transformer')
                            ->findOneBy(array(
                                    'serie'=>$transformer->getSerie(),
                                    'manufacturer'=>$transformer->getManufacturer(),
                                ));
        if($exist_transformer->getMatricule()===null){
        	$exist_transformer->setMatricule($transformer->getMatricule());
        }
	}
	public function conformityOthers($entity)
	{
		$transformer = $entity->getTransformer();
		$entity->setConformity(true);
		$em = $this->dbProvider->EntityManager();
		$exist_transformer = $em->getRepository('DiagnosticBundle:Transformer')
                            ->findOneBy(array(
                                    'serie'=>$transformer->getSerie(),
                                    'manufacturer'=>$transformer->getManufacturer(),
                                ));
       	$entity->setTransformer($exist_transformer);
	}

	// mise à jour statut précédent
	public function conformityDiagnosticUpdate($entity){
		if($entity->getPreviousId()!==null){
			$em = $this->dbProvider->EntityManager();
			$prevEntity= $em->getRepository('DiagnosticBundle:Diagnostic')
                            	->find($entity->getPreviousId());
            $prevEntity->setStatut(false);
		}
	}
	// mise à jour statut précédent
	public function conformityRepairUpdate($entity){
		if($entity->getPreviousId()!==null){
			$em = $this->dbProvider->EntityManager();
			$prevEntity= $em->getRepository('RepairBundle:Repair')
                            	->find($entity->getPreviousId());
            $prevEntity->setStatut(false);
		}
	}
	// mise à jour statut précédent
	public function conformityStoreEntranceUpdate($entity){
		if($entity->getPreviousId()!==null){
			$em = $this->dbProvider->EntityManager();
			$prevEntity= $em->getRepository('StoreEntranceBundle:StoreEntrance')
                            	->find($entity->getPreviousId());
            $prevEntity->setStatut(false);
		}
	}
	// mise à jour statut précédent
	public function conformityThirdPartyUpdate($entity){
		if($entity->getPreviousId()!==null){
			$em = $this->dbProvider->EntityManager();
			$prevEntity= $em->getRepository('ThirdPartyBundle:ThirdParty')
                            	->find($entity->getPreviousId());
            $prevEntity->setStatut(false);
		}
	}
	// mise à jour statut précédent
	public function conformityDowngradingUpdate($entity){
		if($entity->getPreviousId()!==null){
			$em = $this->dbProvider->EntityManager();
			$prevEntity= $em->getRepository('DowngradingBundle:Downgrading')
                            	->find($entity->getPreviousId());
            $prevEntity->setStatut(false);
		}
	}
	
}
