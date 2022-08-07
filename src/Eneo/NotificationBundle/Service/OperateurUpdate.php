<?php
 
// src/Eneo/NotificationBundle/Service/OperateurUpdate.php
namespace Eneo\NotificationBundle\Service;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


/**
* Service d'enregistrement des opérateurs courants.
**
@author Pokem Ladzou email: pokempatrick@yahoo.fr
*/
class OperateurUpdate
{
	private $tokenstorage;

	public function __construct(TokenStorage $tokenstorage)
	{
		$this->tokenstorage 	= $tokenstorage;
	}
	// mise à jour de l'opérateur
	public function operateurUpdate($entity)
	{
		if($this->tokenstorage->getToken()==null){
			return;
		}
		$user=$this->tokenstorage->getToken()->getUser();
		if($user=='anon.'){
			return;
		}
		$entity->setOperateur($user->getName());
		
	}
	
}
