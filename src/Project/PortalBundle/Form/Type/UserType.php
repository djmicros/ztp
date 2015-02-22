<?php

namespace Project\PortalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;


class UserType extends AbstractType
{
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
    // this is actually the default format for single_text
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