<?php

namespace Project\PortalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

/**
 * User add form type
 *
 * @package     ProjectPortalBundle
 * @author        Adrian Kuciel <kontakt@adriankuciel.pl>
 * @link            http://wierzba.wzks.uj.edu.pl/~10_kuciel/ztp/web
 */
 
class UserType extends AbstractType
{
		    /**
     * User register form
     *
     * @param FormBuilderInterface $builder builder
     * @param array                $options options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('username', 'text', array( 
            'label' => false,
            'attr'   =>  array(
                'class'   => 'form-control input-sm chat-input', 'placeholder' => 'Username')
            ))
			->add('password', 'password', array( 'label' => false, 
            'attr'   =>  array(
                'class'   => 'form-control input-sm chat-input', 'placeholder' => 'Password')))
			->add('email', 'text', array( 'label' => false,
            'attr'   =>  array(
                'class'   => 'form-control input-sm chat-input', 'placeholder' => 'Email')))
			->add('gender', 'choice', array( 'label' => false,
  'choice_list' => new ChoiceList(array("m", "f"), array('Male', 'Female')), 'attr'   =>  array(
                'class'   => 'form-control input-sm chat-input')))
			->add('birthDate', 'date', array( 'label' => false,
    'widget' => 'single_text',
    'format' => 'yyyy-MM-dd', 'attr'   =>  array(
                'class'   => 'form-control input-sm chat-input')
))
			->add('city', 'text', array( 'label' => false,
            'attr'   =>  array(
                'class'   => 'form-control input-sm chat-input', 'placeholder' => 'City')))
			->add('phone', 'text', array( 'label' => false,
            'attr'   =>  array(
                'class'   => 'form-control input-sm chat-input', 'placeholder' => 'Phone Number')));
    }

    public function getName()
    {
        return 'PortalBundleFormTypeUserType';
    }

}