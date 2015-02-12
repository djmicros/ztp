<?php

namespace Project\PortalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$time = new \DateTime();
		
        $builder
			->add('title', 'text')
			->add('content', 'textarea')
			//->add('created_at', 'hidden', array('data' => $time))
			;
    }

    public function getName()
    {
        return 'PortalBundleFormTypePostType';
    }

}