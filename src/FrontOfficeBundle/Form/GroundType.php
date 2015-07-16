<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroundType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text',            array('label'=>'Nom du terrain',
                                                  'attr' => array('placeholder'=>'Nom en toutes lettres')))
            ->add('address','text',         array('label'=>'Entrez l\'adresse',
                                                  'attr' => array('placeholder'=>'N° et Nom de la rue')))
            ->add('postCode','integer',     array('label'=>'Saisissez le code postal',
                                                  'attr' => array('placeholder'=>'00000')))
            ->add('place','text',           array('label'=>'Entrez le nom de la ville',
                                                  'attr' => array('placeholder'=>'Nom de la ville')))
            ->add('sport', null,            array('expanded'=>true))
            ->add('phoneNumber','integer',  array('label'=>'Saisissez votre N° de tél',
                                                  'attr' => array('placeholder'=>'0000000000')))
            ->add('openingHours','text',    array('label'=>'Heures d\'ouverture du terrain',
                                                  'attr' => array('placeholder'=>'Heures d\'ouvertures/facultatif')  ))
            ->add('Valider','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeBundle\Entity\Ground'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficebundle_ground';
    }
}
