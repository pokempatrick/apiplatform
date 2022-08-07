<?php
// src/Sdz/UserBundle/Validator/PasswordConstraint.php
namespace Sdz\UserBundle\Validator;
use Symfony\Component\Validator\Constraint;
/**
* @Annotation
*/
class Password extends Constraint
{
	public $message = 'Invalid password.';

}