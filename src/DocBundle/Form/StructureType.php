<?php

namespace DocBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StructureType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',           'text', array(
                                    'required' => false))
            ->add('functionFr',     'text')
            ->add('functionEn',     'text', array(
                                    'required' => false))
            ->add('city',           'text', array(
                                    'required' => false))
            ->add('geoloc',         'text', array(
                                    'required' => false))
            ->add('website',        'text', array(
                                    'required' => false))
            ->add('dateStart',      'date', array(
                                    'widget' => 'single_text',
                                    'input' => 'datetime',
                                    'format' => 'dd/MM/yyyy',
                                    'required' => false))
            ->add('dateEnd',        'date', array(
                                    'widget' => 'single_text',
                                    'input' => 'datetime',
                                    'format' => 'dd/MM/yyyy',
                                    'required' => false))
            ->add('tags',           'entity', array(
                                    'class' => 'DocBundle:Tag',
                                    'choice_label' => 'nameFr',
                                    'multiple' => true,
                                    'expanded' => true))
            ->add('uploadedFiles',  'file', array(
                                    'label' => 'Ajouter des uploadedFiles',
                                    'required' => false,
                                    'multiple' => true, 
                                    'data_class' => null))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DocBundle\Entity\Structure'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'docbundle_structure';
    }
}
