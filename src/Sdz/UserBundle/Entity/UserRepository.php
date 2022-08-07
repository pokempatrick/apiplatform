<?php

namespace Sdz\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
	// recherche un role et unité
	public function findByRoleAndUnite($role, $unite)
	{

		$qb = $this->createQueryBuilder('u');
		$qb->where('u.unite = :unite')
			->setParameter('unite', $unite)
			->andWhere('u.roles LIKE :roles')
			->setParameter('roles','%"'.$role.'"%');
		return $qb->getQuery()->getResult();
	}

	public function findByRole($role)
	{

		$qb = $this->createQueryBuilder('u');
		$qb->Where('u.roles LIKE :roles')
			->setParameter('roles','%"'.$role.'"%');
		return $qb->getQuery()->getResult();
	}
	
	public function getUserIndex($nombreParPage, $page)
	{
		// On déplace la vérification du numéro de page dans cette méthode
		if ($page < 1) {
			throw new \InvalidArgumentException('L\'argument $page ne peut
				être inférieur à 1 (valeur : "'.$page.'").');
		} 
		// La construction de la requête reste inchangée
		/*$query = $this->_em->createQuery('SELECT u FROM SdzUserBundle:User u 
			-- WHERE u.service IN (:service)
			ORDER BY u.entreprise DESC'
			);*/
		$query = $this->_em->createQuery('SELECT u FROM SdzUserBundle:User u 
			ORDER BY u.entreprise DESC'
			);
		// On définit la demande  à partir de laquel commencer la liste
		// $query->setParameter('service', 'school_management');
		$query->setFirstResult(($page-1) * $nombreParPage)
				->setMaxResults($nombreParPage);
		// (n'oubliez pas le use correspondant en début de fichier)
		return new Paginator($query);
	}
	
} 