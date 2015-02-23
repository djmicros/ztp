<?php

namespace Project\PortalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		
        $builder
			->add('msg_body', 'textarea', array( 
            'label' => false,
            'attr'   =>  array(
                'class'   => 'form-control input-sm chat-input', 'placeholder' => 'Write your message...')
            ));

    }

    public function getName()
    {
        return 'PortalBundleFormTypeMessageType';
    }

}

