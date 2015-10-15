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
                                                  'attr' => array('placeholder'=>'Nom usuel, appellation, surnom')))
            ->add('address','text',         array('label'=>'Adresse',
                                                  'attr' => array('placeholder'=>'N° et nom de la rue')))
            ->add('postCode','integer',     array('label'=>'Code postal',
                                                  'attr' => array('placeholder'=>'75')))
            ->add('place','text',           array('label'=>'Ville',
                                                  'attr' => array('placeholder'=>'Paris')))
            ->add('sport', null,            array('label'=>'Sports',
                                                  'expanded'=>true))            
            ->add('openingHours','text',    array('label'=>'Jours et heures d\'ouverture',
                                                  'attr' => array('placeholder'=>'lundi-vendredi 8h-20h ; samedi 10h-22h30 ; dimanche 9h-17h15')))
            ->add('mode','choice',          array('label'=>'Terrain public / accès privé',
                                                  'choices'=> array('public' =>'Public',
                                                                    'private'=>'Privé'),
                                                  'expanded'=> true))
            ->add('file','file', array('required'=> false))
            ->add('fees','checkbox',        array('label'     => 'accès payant',
                                                  'required'  => false))
            ->add('phoneNumber','integer',  array('label'=>'Téléphone',
                                                  'attr' => array('placeholder'=>'0100000000')))
            ->add('comment','text',         array('label'=>'Commentaire (Niveau de jeu, ambiance, jour le plus fréquenté, type de revêtement, point d\'eau...)',
                                                  'attr' => array('placeholder'=>'Niveau de jeu...')))
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
