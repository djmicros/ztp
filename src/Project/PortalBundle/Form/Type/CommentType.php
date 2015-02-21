<?php

namespace Project\PortalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		
        $builder
			->add('comment_body', 'textarea');

    }

    public function getName()
    {
        return 'PortalBundleFormTypeCommentType';
    }

}

