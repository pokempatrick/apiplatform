<?php
// src/Sdz/UserBundle/Form/UserUpdatePassType.php

namespace Sdz\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserUpdatePassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('username')
            ->remove('entreprise')
            ->remove('nieuser')
            ->remove('niuentreprise')
            ->remove('numeroTelephone')
            ->remove('magasin')
            ->remove('unite')
            ->remove('name')
            ;

    } 

    public function getName()
    {
        return 'sdz_userbundle_userupdatepass';
    }

    public function getParent()
    {
        return UserType::class;
    }
}