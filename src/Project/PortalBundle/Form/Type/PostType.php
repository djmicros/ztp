<?php

namespace Project\PortalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		
        $builder
			->add('post_body', 'textarea', array( 
            'label' => false,
            'attr'   =>  array(
                'class'   => 'form-control input-sm chat-input', 'placeholder' => 'What is on your mind...?')
            ));
			
		$builder->add('tag', new TagType(), array('label' => false));

    }

    public function getName()
    {
        return 'PortalBundleFormTypePostType';
    }

}

