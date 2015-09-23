<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MatcheType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('place')
            ->add('dateplay')
            ->add('mode', 'choice', array('choices'=> array('compet'=>'Compétition',
                                                            'loisir'=>'Loisir')))                       
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
            'data_class' => 'FrontOfficeBundle\Entity\Matche'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficebundle_matche';
    }
}
