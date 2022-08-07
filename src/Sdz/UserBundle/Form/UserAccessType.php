<?php
// src/Sdz/UserBundle/Form/UserRoleAdminType.php

namespace Sdz\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class UserAccessType extends AbstractType
{
      public function buildForm(FormBuilderInterface $builder, array $options)
      {
        $builder->remove('name')
                ->remove('username')
                ->remove('plainpassword')
                ->remove('nieuser')
                ->remove('niuentreprise')
                ->remove('entreprise')
                ->remove('numeroTelephone')
                ->add('limitedaccessdate', DateType::class, 
                    array('widget' => 'single_text',))
                ->add('service', ChoiceType::class, array(
                  'choices'  => array(
                      'school_management'       => 'school_management',
                      'store_management'        => 'store_management',
                      'high_school_managemet'   => 'high_school_managemet',
                  ),
                  // *this line is important*
                  'choices_as_values' => true,
                  'multiple'=> false,
                  'expanded'=> false,
              ))
                ;
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