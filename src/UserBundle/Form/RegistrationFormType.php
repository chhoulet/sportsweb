<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder
            ->add('sportPracticed','choice', array('choices'  => array('Foot'=>'Football',
                                                                       'Bask'=>'Basket'),
                                                   'expanded' => true,
                                                   'multiple' => true))
            ->add('sportViewed', 'choice',   array('choices'  => array('Foot'=>'Football',
                                                                       'Bask'=>'Basket'),
                                                   'multiple' => true,
                                                   'expanded' => true))
            ->add('age')
        ;
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'user_registration';
    }
}