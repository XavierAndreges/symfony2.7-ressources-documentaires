<?php

namespace DocBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TechnoType extends AbstractType
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
            ->add('textFr',         'textarea', array(
                                    'attr' => array('rows' => '10'),
                                    'required' => false))
            ->add('textEn',         'textarea', array(
                                    'attr' => array('rows' => '10'),
                                    'required' => false))
            ->add('webSite',        'text', array(
                                    'required' => false))
            ->add('technoCategory', 'entity', array(
                                    'class' => 'DocBundle:TechnoCategory',
                                    'choice_label' => 'nameFr',
                                    'required' => false))
            ->add('workType',       'entity', array(
                                    'class' => 'DocBundle:WorkType',
                                    'choice_label' => 'nameFr',
                                    'required' => false))
            ->add('experienceTime', 'text', array(
                                    'required' => false))
            ->add('startedYear',    'text', array(
                                    'required' => false))
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
            'data_class' => 'DocBundle\Entity\Techno'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'docbundle_techno';
    }
}
