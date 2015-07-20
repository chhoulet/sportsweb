<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text',       array('label'   =>'Titre de l\'article:',
                                              'attr'    => array('placeholder'=>'Entrez le titre:')))
            ->add('content','text',     array('label'   =>'Contenu de l\'article:',
                                              'attr'    => array('placeholder'=>'Votre texte:')))
            ->add('sport', null,        array('label'   =>'Sport concerné:'))                                               
            ->add('Editer', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficebundle_article';
    }
}
