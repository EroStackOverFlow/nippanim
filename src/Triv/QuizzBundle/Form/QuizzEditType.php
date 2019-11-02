<?php
// src/Triv/QuizzBundle/Form/QuizzEditType.php

namespace Triv\QuizzBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class QuizzEditType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->remove('date');
  }

  public function getName()
  {
    return 'Triv_quizzbundle_quizz_edit';
  }

  public function getParent()
  {
    return new QuizzType();
  }
}