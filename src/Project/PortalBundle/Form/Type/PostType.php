<?php

namespace Project\PortalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		
        $builder
			->add('post_body', 'textarea');
			
		$builder->add('tag', new TagType());

    }

    public function getName()
    {
        return 'PortalBundleFormTypePostType';
    }

}

