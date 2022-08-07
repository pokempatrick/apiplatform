<?php
 
// src/Sdz/UserBundle/Service/CronAnonyme.php
namespace Sdz\UserBundle\Service;
use  Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;



/**
* Service de résiliation d'abonnement pour impayé
**
@author Pokem Ladzou email: pokempatrick@yahoo.fr
*/
class Subscription
{
    private $doctrine;
	private $tokenstorage;

    public function __construct(Registry $doctrine, TokenStorage $tokenstorage)
    {
        $this->doctrine     = $doctrine;
        $this->tokenstorage = $tokenstorage;
    }

	public function renew($entity)
	{
		$em = $this->doctrine->getManager('user');
        $entities = $em->getRepository('SdzUserBundle:User')
                        ->findByEntreprise($entity->getEntreprise());
        foreach ($entities as $value) {
            $value->setLimitedaccessdate($entity->getLimitedaccessdate());
        }
        $em->flush();
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
