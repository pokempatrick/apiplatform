<?php
// src/Sdz/UserBundle/Form/UserResetPassType.php

namespace Sdz\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserResetPassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('name')
              ->remove('magasin')
              ->remove('numeroTelephone')
              ->remove('entreprise')
              ->remove('nieuser')
              ->remove('niuentreprise')
              ->remove('plainpassword')
              ;
    }

    public function getName()
    {
        return 'sdz_userbundle_userresetpass';
    }

    public function getParent()
    {
        return UserType::class;
    }
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' => false,
        ));
    }
}