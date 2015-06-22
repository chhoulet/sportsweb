<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupPlayerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('practicedSport','choice', array('choices' => array('Basket'   => 'Basket',
                                                                      'Football' => 'Football')))
            //->add('typeOfGame') Toujours en mode loisir
            ->add('club')
            ->add('habitsOfGame')
            ->add('groupComment')
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
            'data_class' => 'FrontOfficeBundle\Entity\GroupPlayer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficebundle_groupplayer';
    }
}
