<?php
 
// src/Sdz/UserBundle/Service/CronAnonyme.php
namespace Sdz\UserBundle\Service;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;



/**
* Service de résiliation d'abonnement pour impayé
**
@author Pokem Ladzou email: pokempatrick@yahoo.fr
*/
class EncodePassWord
{
	private $userPasswordEncoder;

    public function __construct(UserPasswordEncoder $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }
    // encodage du mot de passe
	public function passWordEncode($entity)
	{
        if($entity->getPlainpassword() !== null){
    		$password = $this->userPasswordEncoder
                    ->encodePassword($entity, $entity->getPlainpassword());
            $entity->setPassword($password);
        }
	}
}
