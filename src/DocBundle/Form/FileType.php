<?php

namespace DocBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fileName',           'text', array(
                                        'required' => true))
            ->add('nameFr',             'text', array(
                                        'required' => false))
            ->add('nameEn',             'text', array(
                                        'required' => false))
            ->add('size',               'text', array(
                                        'required' => false))
            ->add('works',              'entity', array(
                                        'class' => 'DocBundle:Work',
                                        'choice_label' => 'nameFr'))
            ->add('structures',         'entity', array(
                                        'class' => 'DocBundle:Structure',
                                        'choice_label' => 'name'))
            ->add('jobs',               'entity', array(
                                        'class' => 'DocBundle:Job',
                                        'choice_label' => 'functionFr'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DocBundle\Entity\File'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'docbundle_file';
    }
}
