<?php

namespace Project\PortalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Message form type
 *
 * @package     ProjectPortalBundle
 * @author        Adrian Kuciel <kontakt@adriankuciel.pl>
 * @link            http://wierzba.wzks.uj.edu.pl/~10_kuciel/ztp/web
 */

class MessageType extends AbstractType
{
            /**
     * Message form
     *
     * @param FormBuilderInterface $builder builder
     * @param array                $options options
     *
     * @return void
     */
     
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
