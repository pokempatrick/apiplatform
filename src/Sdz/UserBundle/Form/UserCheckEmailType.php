<?php
// src/Sdz/UserBundle/Form/UserCheckEmailType.php

namespace Sdz\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserCheckEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('name')
                ->remove('magasin')
                ->remove('username')
                ->remove('entreprise')
                ->remove('nieuser')
                ->remove('niuentreprise')
                ->remove('plainpassword')
                ->remove('numeroTelephone')
                ->add('code');
    }

    public function getName()
    {
        return 'sdz_userbundle_usercheckemail';
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