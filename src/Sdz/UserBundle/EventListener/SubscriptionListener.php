<?php
// src/Sdz/UserBundle/EventListener/OperateurUpdateListener.php
namespace Sdz\UserBundle\EventListener;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Sdz\UserBundle\Service\Subscription;
use Sdz\UserBundle\Service\EncodePassWord;
use Sdz\UserBundle\Entity\User;


class SubscriptionListener
{
	private $subscription;
	private $encodepassword;
	public function __construct( Subscription $subscription, EncodePassWord $encodepassword )
	{
		$this->subscription=$subscription;
		$this->encodepassword = $encodepassword;
	}
	public function preUpdate(LifecycleEventArgs $args)
	{
		$entity = $args->getEntity();
		$this->updateOperateur($entity);
		$this->updatePassWord($entity);
	}
	public function prePersist(LifecycleEventArgs $args)
	{
		$entity = $args->getEntity();
		$this->updateOperateur($entity);
		$this->updatePassWord($entity);
	}
	
	// encodage du mot de passe
	private function updatePassWord($entity)
	{
		if (!($entity instanceof User)) {
			return;
		}
		$this->encodepassword->passWordEncode($entity);
	}
	// mise à jour àccès à l'application
	private function updateSubscription($entity)
	{
		if (!($entity instanceof User )) {
			return;
		}
		$this->subscription->renew($entity);
	}

	//mise à jour opérateur
	private function updateOperateur($entity)
	{
		if (!($entity instanceof User)) {
			return;
		}
		$this->subscription->operateurUpdate($entity);
	}

}