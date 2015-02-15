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
			->add('username', 'text')
			->add('password', 'password')
			->add('email', 'text')
			->add('gender', 'choice', array(
  'choice_list' => new ChoiceList(array("m", "f"), array('Male', 'Female'))))
			->add('birth_date', 'date', array(
    'widget' => 'single_text',
    // this is actually the default format for single_text
    'format' => 'yyyy-MM-dd',
))
			->add('city', 'text')
			->add('phone', 'text');
    }

    public function getName()
    {
        return 'PortalBundleFormTypeUserType';
    }

}