<?php
// src/Triv/AnimesBundle/Form/AnimesEditType.php

namespace Triv\AnimesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AnimesEditType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->remove('date');
  }

  public function getName()
  {
    return 'Triv_animesbundle_animes_edit';
  }

  public function getParent()
  {
    return new AnimesType();
  }
}