<?php

namespace Project\PortalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Edit post form type
 *
 * @package     ProjectPortalBundle
 * @author        Adrian Kuciel <kontakt@adriankuciel.pl>
 * @link            http://wierzba.wzks.uj.edu.pl/~10_kuciel/ztp/web
 */
 
class EditPostType extends AbstractType
{
		    /**
     * Post editing form
     *
     * @param FormBuilderInterface $builder builder
     * @param array                $options options
     *
     * @return void
     */
	 
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

