<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MessageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author','text',      array('label'   =>'Username',
                                              'attr'    => array('placeholder'=>'Nom d\'utilisateur:')))
            ->add('subject','choice',   array('label'   =>'Choisissez votre thème:',
                                              'choices' => array('Proposition de partenariat'=>'proposition',
                                                                 'Emploi'                    =>'emploi',
                                                                 'Commentaires sur le site'  =>'comment',
                                                                 'Autre'                     =>'autre')))
            ->add('email', 'text',      array('label' =>'Adresse e-mail:',
                                              'attr'  => array('placeholder'=>'xxxx@cccc.com')))
            ->add('content', 'text',    array('label' =>'Message:',
                                              'attr'  => array('placeholder'=>'Vos commentaires sont les bienvenus')))                        
            ->add('Envoyer','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeBundle\Entity\Message'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficebundle_message';
    }
}
