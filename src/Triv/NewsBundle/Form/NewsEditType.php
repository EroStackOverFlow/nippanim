<?php
// src/Triv/NewsBundle/Form/NewsEditType.php

namespace Triv\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsEditType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->remove('date');
  }

  public function getName()
  {
    return 'Triv_newsbundle_news_edit';
  }

  public function getParent()
  {
    return new NewsType();
  }
}