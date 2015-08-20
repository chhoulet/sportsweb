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
            ->add('name','text',          array('label'  =>'Nom de l\équipe',
                                                'attr'   => array('placeholder'=>'Papillons, Tigres, Olympique Lyonnais ...')))
            ->add('sportPracticed', null, array('label'  =>'Sport pratiqué',
                                                'attr'   => array('placeholder'=>'Football, Handball, Basket, Rugby ...')))
            ->add('typeOfGame', 'choice', array('label'  =>'Niveau de jeu',
                                                'choices'=> array('Loisir'               => "loisir",
                                                                  'Compétition'          => "compétition",
                                                                  'Loisir & Compétition' => 'loisir&compet')))
            ->add('habitsOfGame','text',  array('label'  =>'Habitudes de jeu',
                                                'attr'   => array('placeholder'=>'Niveau de jeu, jours et heures de pratique sportive, ...')))
            ->add('teamComment','text',   array('label'  =>'Commentaire',
                                                'attr'   => array('placeholder'=>'Nombre de joueurs, commentaire libre')))
            ->add('ground', null,         array('label'  =>'Selection du terrain:'))
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
