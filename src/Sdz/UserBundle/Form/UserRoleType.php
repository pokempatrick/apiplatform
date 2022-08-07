<?php
// src/Sdz/UserBundle/Form/UserRoleType.php

namespace Sdz\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('name')
              ->remove('magasin')
              ->remove('nieuser')
              ->remove('niuentreprise')
              ->remove('entreprise')
              ->remove('numeroTelephone')
              ->remove('username')
              ->remove('plainpassword')
              ->remove('unite')
              ->add('roles', ChoiceType::class, array(
                  'choices'  => array(
                      'Super Administrateur'  => 'ROLE_SUPER_ADMIN',
                      'Administrateur'        => 'ROLE_ADMIN',
                      'Propriétaire'          => 'ROLE_OWNER',
                      'Directeur'             => 'ROLE_DIRECTOR',
                      'Responsable d\'agence' => 'ROLE_SUB_DIRECTOR',
                      'Comptable'             => 'ROLE_ACCOUNTANT',
                      'Vendeur'               => 'ROLE_SELLER',
                      'Caissier'              => 'ROLE_CASHIER',
                      'Assistant Propriétaire'=> 'ROLE_SECRETARY',
                      'Observateur'           => 'ROLE_VIEWER',
                      'anonymous'             => 'anonymous',
                  ),
                  // *this line is important*
                  'choices_as_values' => true,
                  'multiple'=> true,
                  'expanded'=> true,
              ));   
    }

    public function getName()
    {
        return 'sdz_userbundle_userrole';
    }

    public function getParent()
    {
        return UserType::class;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' => false,
       ));
    }
}