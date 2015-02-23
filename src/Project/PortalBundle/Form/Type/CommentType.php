<?php

namespace Project\PortalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Comment form type
 *
 * @package     ProjectPortalBundle
 * @author        Adrian Kuciel <kontakt@adriankuciel.pl>
 * @link            http://wierzba.wzks.uj.edu.pl/~10_kuciel/ztp/web
 */
 
class CommentType extends AbstractType
{
        /**
     * Comment form
     *
     * @param FormBuilderInterface $builder builder
     * @param array                $options options
     *
     * @return void
     */
     
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('comment_body', 'textarea', array(
            'label' => false,
            'attr'   =>  array(
                'class'   => 'form-control input-sm chat-input', 'placeholder' => 'Your comment...')
            ));

    }

    public function getName()
    {
        return 'PortalBundleFormTypeCommentType';
    }
}
