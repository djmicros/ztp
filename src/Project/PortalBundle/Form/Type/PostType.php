<?php

namespace Project\PortalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Add post form type
 *
 * @package     ProjectPortalBundle
 * @author        Adrian Kuciel <kontakt@adriankuciel.pl>
 * @link            http://wierzba.wzks.uj.edu.pl/~10_kuciel/ztp/web
 */

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
                /**
     * Post form
     *
     * @param FormBuilderInterface $builder builder
     * @param array                $options options
     *
     * @return void
     */
        
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
