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
        $builder->add('sport', 'entity', array('class'        => 'FrontOfficeBundle:Sport',
                                               'choice_label' => 'name'))
            
                ->add('region', 'choice', array('label'   =>'Region:',
                                            'choices' => array('Ile-de-France' =>'Ile-de-France',
                                                              'Sud-Ouest'     =>'Sud-Ouest',
                                                              'Ouest'         =>'Ouest',
                                                              'Sud-Est'       =>'Sud-Est',
                                                              'Est'           =>'Est',
                                                              'Nord'          =>'Nord'))) 
                ->add('Afficher la selection', 'submit');
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficebundle_triinvitation';
    }    

}
