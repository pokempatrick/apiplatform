<?php
 
// src/Sdz/UserBundle/Service/CronAnonyme.php
namespace Sdz\UserBundle\Service;
use  Doctrine\Bundle\DoctrineBundle\Registry;



/**
* Service de résiliation d'abonnement pour impayé
**
@author Pokem Ladzou email: pokempatrick@yahoo.fr
*/
class CronAnonyme
{
	private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine     = $doctrine;
    }

	public function desable()
	{
		$em = $this->doctrine->getManager('user');
        $entities = $em->getRepository('SdzUserBundle:User')->findAll();
        foreach ($entities as $key => $entity) {
            if(!(in_array('ROLE_ADMIN', $entity->getRoles()))||
                !(in_array('ROLE_SUPER_ADMIN', $entity->getRoles()))){
                $entities[$key]->setRoles('anonymous');
            }
        }
        $em->flush();
        
	}

}
