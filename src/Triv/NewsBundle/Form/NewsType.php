<?php
// src/Triv/NewsBundle/Form/NewsType.php

namespace Triv\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
	  ->add('titre',   'text')
	  ->add('content',   'textarea')
      ->add('enregistrer',      'submit')
	  ->add('effacer',      'reset')
    ;

   }
   

  /**
   * @param OptionsResolverInterface $resolver
   */
  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Triv\NewsBundle\Entity\News'
    ));
  }

  /**
   * @return string
   */
  public function getName()
  {
    return 'Triv_newsbundle_news';
  }
}