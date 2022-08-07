<?php
 
// src/Eneo/NotificationBundle/Service/DatabaseProvider.php
namespace Eneo\NotificationBundle\Service;
use  Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
* Service choix de l'entity manager.
**
@author Pokem Ladzou email: pokempatrick@yahoo.fr
*/
class DatabaseProvider
{
	private $doctrine;
	private $tokenstorage;

	public function __construct(Registry $doctrine, TokenStorage $tokenstorage)
	{
		$this->doctrine 	= $doctrine;
		$this->tokenstorage 	= $tokenstorage;
	}

	public function EntityManager()
	{
		$user=$this->tokenstorage->getToken()->getUser();
        return $this->doctrine->getManager($user->getEntreprise());
        // return $this->doctrine->getManager('default');
	}
}
