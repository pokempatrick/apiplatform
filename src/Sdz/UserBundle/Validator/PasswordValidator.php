<?php
 
// src/Sdz/UserBundle/Validator/PasswordValidator.php
namespace Sdz\UserBundle\Validator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;



/**
* Service d'enregistrement des opérateurs courants.
**
@author Pokem Ladzou email: pokempatrick@yahoo.fr
*/
class PasswordValidator  extends ConstraintValidator
{

	public function validate($value, Constraint $constraint)
	{
		
		if(!(preg_match("#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$#", $value))){
            $this->context->addViolation($constraint->message);
		}

	}

}
