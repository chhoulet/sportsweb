<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InvitationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content')
            ->add('dateInvit', 'date')
            ->add('sport', 'choice', array('choices'=> array('football' => 'Football',
                                                             'basket'   => 'Basket')))
            ->add('place')
            ->add('ground')
            ->add('player')
            ->add('Lancer', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeBundle\Entity\Invitation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficebundle_invitation';
    }
}
