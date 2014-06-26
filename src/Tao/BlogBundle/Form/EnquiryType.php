<?php
/**
 * Created by PhpStorm.
 * User: jintao
 * Date: 25/06/2014
 * Time: 16:20
 */

namespace Tao\BlogBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EnquiryType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('email','email');
        $builder->add('subject');
        $builder->add('body','textarea');
    }
    public function getName()
    {
        return 'contact';
    }
} 