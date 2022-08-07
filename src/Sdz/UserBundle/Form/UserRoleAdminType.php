<?php
// src/Sdz/UserBundle/Form/UserRoleAdminType.php

namespace Sdz\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class UserRoleAdminType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->remove('name')
            ->remove('magasin')
            ->remove('username')
            ->remove('plainpassword')
            ->remove('entreprise')
            ->remove('nieuser')
            ->remove('niuentreprise')
            ->remove('numeroTelephone')
            ->add('roles', ChoiceType::class, array(
                'choices'  => array(
                    'Propriétaire'          => 'ROLE_OWNER',
                    'Directeur'             => 'ROLE_DIRECTOR',
                    'Responsable d\'agence' => 'ROLE_SUB_DIRECTOR',
                    'Comptable'             => 'ROLE_ACCOUNTANT',
                    'Vendeur'               => 'ROLE_SELLER',
                    'Caissier'              => 'ROLE_CASHIER',
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