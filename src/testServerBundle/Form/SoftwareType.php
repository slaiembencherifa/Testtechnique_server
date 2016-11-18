<?php

/**
 * Created by PhpStorm.
 * User: sloum
 * Date: 18/11/2016
 * Time: 11:47
 */
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SoftwareType extends AbstractType
{   /**
 * @param FormBuilderInterface $builder
 * @param array $options
 */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('nom')
            ->add('editeur')
            ->add('description');
    }
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'test\serverBundle\Entity\Software'
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'testserverBundle_software';
    }
}