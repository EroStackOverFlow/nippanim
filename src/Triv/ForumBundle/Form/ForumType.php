<?php
// src/Triv/ForumBundle/Form/ForumType.php

namespace Triv\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ForumType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('image',      new ForumImageType())
      ->add('content',   'textarea')
      ->add('poster',      'submit')
	  ->add('effacer',      'reset')
    ;

   }
   

  /**
   * @param OptionsResolverInterface $resolver
   */
  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Triv\ForumBundle\Entity\Forum'
    ));
  }

  /**
   * @return string
   */
  public function getName()
  {
    return 'Triv_forumbundle_forum';
  }
}