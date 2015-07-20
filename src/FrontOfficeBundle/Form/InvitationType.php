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
            ->add('content','text',     array('label'  =>'Texte libre:',
                                              'attr'   => array('placeholder'=>'contexte, joueurs invités ...')))
            ->add('dateInvit', 'date',  array('label'  =>'Date de la recontre:'))
            ->add('sport', null,        array('label'  =>'Sport pratiqué:',
                                              'attr'   => array('expanded'   => true)))
            ->add('mode','choice',      array('label'  =>'Mode de jeu:',
                                              'choices'=> array('Loisir'     => "Loisir",
                                                                'Compétition'=> "Compétition")))
            ->add('place', 'text',      array('label'  =>'Ville de la rencontre:',
                                              'attr'   => array('placeholder'=>'Bobigny, Versailles, Tours, Paris 15, ...')))
            ->add('ground','text',      array('label'  =>'Terrain de la rencontre:',
                                              'attr'   => array('placeholder'=>'Hall Carpentier, stade Jean Mouchotte, bois de Vincennes,...')))
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
