<?php
 
// src/Sdz/UserBundle/Service/ResiliatonAdder.php
namespace Sdz\UserBundle\Service;
use Symfony\Component\HttpFoundation\Response;
use  Doctrine\Bundle\DoctrineBundle\Registry;

/**
* Service de résiliation d'abonnement pour impayé
**
@author Pokem Ladzou email: pokempatrick@yahoo.fr
*/
class AccessResiliation
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine     = $doctrine;
    }

    public function anonymous($user)  {
        $em = $this->doctrine->getManager('default');;
        $user = $em->getRepository('SdzUserBundle:User')
                            ->find($user->getId());
        $user->setRoles(array('anonymous'=>'anonymous'));
        $em->flush();  
    }


}
