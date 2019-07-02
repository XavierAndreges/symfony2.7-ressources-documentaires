<?php

namespace DocBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DocBundle\Form\WorkTypeType;

class WorkType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameFr',         'text', array(
                                    'required' => false))

            ->add('nameEn',         'text', array(
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

            ->add('city',           'text', array(
                                    'required' => false))

            ->add('geoloc',         'text', array(
                                    'required' => false))

            ->add('workType',       'entity', array(
                                    'class' => 'DocBundle:WorkType',
                                    'choice_label' => 'nameFr'))

            ->add('website',        'text', array(
                                    'required' => false))

            ->add('linkVideo1',     'text', array(
                                    'required' => false))

            ->add('linkVideo2',     'text', array(
                                    'required' => false))

            ->add('job',            'entity', array(
                                    'class' => 'DocBundle:Job',
                                    'choice_label' => 'functionFr',
                                    'required' => false))

            ->add('structure',      'entity', array(
                                    'class' => 'DocBundle:Structure',
                                    'choice_label' => 'name',
                                    'required' => false))

            ->add('technos',        'entity', array(
                                    'class' => 'DocBundle:Techno',
                                    'choice_label' => 'name',
                                    'multiple' => true,
                                    'expanded' => true))
            
            //->add('workType',        new WorkTypeType())
    /*                                
            ->add('workType',       'collection', array(
                                        'type'         => new WorkTypeType(),
                                        'allow_add'    => true,
                                        'allow_delete' => true
                                      ))
*/
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

            ->add('save',           'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DocBundle\Entity\Work'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'docbundle_work';
    }
}
