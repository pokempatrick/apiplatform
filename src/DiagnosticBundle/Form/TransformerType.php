<?php

namespace DiagnosticBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransformerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('serie')->add('matricule')->add('manufacturer')->add('tensioncourtcircuit')->add('noloadcurent')->add('primarytension')->add('secondarytension')->add('puissance')->add('secondarycurrent')->add('primarycurrent')->add('couplage')->add('year')->add('oil')->add('commutateur');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DiagnosticBundle\Entity\Transformer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'diagnosticbundle_transformer';
    }


}
