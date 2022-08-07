<?php
// src/NotificationBundle/EventListener/OperateurUpdateListener.php
namespace Eneo\NotificationBundle\EventListener;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Eneo\NotificationBundle\Service\OperateurUpdate;
use Eneo\NotificationBundle\Service\ConformityUpdate;
use DiagnosticBundle\Entity\Diagnostic;
use DiagnosticBundle\Entity\InspectionVisuelle;
use DiagnosticBundle\Entity\Manufacturer;
use DiagnosticBundle\Entity\Result;
use DiagnosticBundle\Entity\TurnRatio;
use DiagnosticBundle\Entity\Isolement;
use DowngradingBundle\Entity\Downgrading;
use QualityBundle\Entity\Quality;
use StoreEntranceBundle\Entity\StoreEntrance;
use ThirdPartyBundle\Entity\ThirdParty;
use RepairBundle\Entity\Repair;
use RepairBundle\Entity\SparePart;

class OperateurUpdateListener
{
	private $operateurUpdate;
	private $conformityUpdate;
	public function __construct( OperateurUpdate $operateurUpdate,
		 ConformityUpdate $conformityUpdate)
	{
		$this->operateurUpdate = $operateurUpdate;
		$this->conformityUpdate = $conformityUpdate;
	}
	public function preUpdate(LifecycleEventArgs $args)
	{
		$entity = $args->getEntity();
		$this->preUpdateOperateur($entity);
	}

	public function prePersist(LifecycleEventArgs $args)
	{
		$entity = $args->getEntity();
		$this->prePersitOperateur($entity);
		$this->diagnosticConformity($entity);
		$this->qualityConformity($entity);
		$this->repairConformity($entity);
		$this->thirdPartyConformity($entity);
		$this->storeEntranceConformity($entity);
		$this->downgradingConformity($entity);
	}
	private function prePersitOperateur($entity){
		// notification mise à jour des opérateurs
		if (!($entity instanceof Diagnostic
				||$entity instanceof StoreEntrance
				||$entity instanceof ThirdParty
				||$entity instanceof Downgrading
				||$entity instanceof Repair
				||$entity instanceof Quality
				||$entity instanceof InspectionVisuelle
				||$entity instanceof TurnRatio
				||$entity instanceof Isolement
				||$entity instanceof Manufacturer
				||$entity instanceof Result
				||$entity instanceof Transformer
			)) {
			return;
		}
		$this->operateurUpdate->operateurUpdate($entity);
	}
	private function preUpdateOperateur($entity)
	{
		if (!($entity instanceof Manufacturer
				||$entity instanceof Transformer
				||$entity instanceof StoreEntrance
				||$entity instanceof ThirdParty
				||$entity instanceof Downgrading
				||$entity instanceof Repair
				||$entity instanceof Quality
			)) {
			return;
		}
		$this->operateurUpdate->operateurUpdate($entity);
	}

	// vérification numéro de série et mise à jour conformité
	private function diagnosticConformity($entity)
	{
		if (!$entity instanceof Diagnostic) {
			return;
		}
		$this->conformityUpdate->conformityDiagnostic($entity);
		$this->conformityUpdate->conformityDiagnosticUpdate($entity);
	}

	// mise à jour immatriculation et mise à jour conformité
	private function qualityConformity($entity)
	{
		if (!$entity instanceof Quality) {
			return;
		}
		$this->conformityUpdate->conformityQuality($entity);
		$this->conformityUpdate->conformityQualityUpdate($entity);
	}

	// vérification numéro de série, immatriculation et mise à jour conformité
	private function storeEntranceConformity($entity)
	{
		if (!$entity instanceof StoreEntrance ) {
			return;
		}
		$this->conformityUpdate->conformityNewTransformer($entity);
		$this->conformityUpdate->conformityStoreEntranceUpdate($entity);
	}

	// vérification numéro de série, immatriculation et mise à jour conformité
	private function thirdPartyConformity($entity)
	{
		if (!$entity instanceof ThirdParty ) {
			return;
		}
		$this->conformityUpdate->conformityNewTransformer($entity);
		$this->conformityUpdate->conformityThirdPartyUpdate($entity);
	}

	// attribution transformateur et mise à jour conformité
	private function repairConformity($entity)
	{
		if (!$entity instanceof Repair ) {
			return;
		}
		$this->conformityUpdate->conformityOthers($entity);
		$this->conformityUpdate->conformityRepairUpdate($entity);
	}

	// attribution transformateur et mise à jour conformité
	private function downgradingConformity($entity)
	{
		if (!$entity instanceof Repair ) {
			return;
		}
		$this->conformityUpdate->conformityOthers($entity);
		$this->conformityUpdate->conformityDowngradingUpdate($entity);
	}
}