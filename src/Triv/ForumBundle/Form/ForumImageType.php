<?php
// src/Triv/ForumBundle/Form/ForumImageType.php

namespace Triv\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ForumImageType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('file', 'file')
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Triv\ForumBundle\Entity\ForumImage'
    ));
  }

  public function getName()
  {
    return 'Triv_forumbundle_forumImage';
  }
}