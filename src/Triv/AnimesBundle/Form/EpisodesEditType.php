<?php
// src/Triv/AnimesBundle/Form/EpisodesEditType.php

namespace Triv\AnimesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EpisodesEditType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->remove('date');
  }

  public function getName()
  {
    return 'Triv_animesbundle_episodes_edit';
  }

  public function getParent()
  {
    return new EpisodesType();
  }
}