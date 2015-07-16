<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TriInvitationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sport', 'choice', array('choices' => array('foot'=>'Football',
                                                              'basket'  =>'Basket',
                                                              'hand'=>'Handball',
                                                              'rugby'   =>'Rugby')))            
            ->add('place', 'choice', array('choices' => array('paris'=>'Paris',
                                                              'lyon' => 'Lyon')))            
            ->add('Afficher la selection', 'submit')
        ;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficebundle_triinvitation';
    }
}
