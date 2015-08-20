<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder
            ->add('ground',         null, array('label'    =>'Terrain de sport favori:',
                                                'attr'     => array('placeholder'=>'Halle Carpentier, gymnase Serge Blanco ...')))
            ->add('place','text',         array('label'    =>'Ville:',
                                                'attr'     => array('placeholder'=>'Paris, Marseille,Le Mirail ...')))
           /* ->add('favouriteSport', null, array('label'    =>'Sport favori:',
                                                'expanded' => true,
                                                'multiple' => true))
            ->add('sportPracticed', null, array('label'    =>'Sports pratiqués:',
                                                'expanded' => true,
                                                'multiple' => true))
            ->add('sportViewed',    null, array('label'    =>'Sports éditoriaux:',
                                                'multiple' => true,
                                                'expanded' => true))*/
            ->add('age')
        ;

        // Si l'utilisateur est déjà inscrit, et donc connecté, alors on rajoute le bouton submit.
        if ($builder->getData()) {
            $builder->add('Enregistrer', 'submit');
        }
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'user_registration';
    }
}