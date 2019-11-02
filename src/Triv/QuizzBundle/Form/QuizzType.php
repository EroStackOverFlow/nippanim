<?php
// src/Triv/QuizzBundle/Form/QuizzType.php

namespace Triv\QuizzBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuizzType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', 'text')
	  ->add('url',   'text')
	  ->add('auteur',   'text')
	  ->add('identifiant',   'integer')
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
      'data_class' => 'Triv\QuizzBundle\Entity\Quizz'
    ));
  }

  /**
   * @return string
   */
  public function getName()
  {
    return 'Triv_quizzbundle_quizz';
  }
}