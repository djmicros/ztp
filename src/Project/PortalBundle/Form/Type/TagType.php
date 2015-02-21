<?php

namespace Project\PortalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tag_name', 'text', array('required' => false, 'label' => "Tag:"));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\PortalBundle\Entity\Tag',
        ));
    }

    public function getName()
    {
        return 'category';
    }
}