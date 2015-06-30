<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TeamType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('sportPracticed','choice', array('choices'=> array('Basket'  => "Basket",
                                                                     'Football'=> "Football")))
            ->add('typeOfGame', 'choice',    array('choices'=> array('Loisir'     => "loisir",
                                                                     'Compétition'=> "compétition")))
            ->add('habitsOfGame')
            ->add('teamComment')
            ->add('ground')
            ->add('Valider','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeBundle\Entity\Team'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficebundle_team';
    }
}
