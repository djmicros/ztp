<?php

namespace Project\PortalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		
        $builder
			->add('msg_body', 'textarea', array('label' => false));

    }

    public function getName()
    {
        return 'PortalBundleFormTypeMessageType';
    }

}

