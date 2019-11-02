<?php
// src/Triv/ForumBundle/Form/ForumEditType.php

namespace Triv\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ForumEditType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->remove('date');
	$builder->remove('image');
  }

  public function getName()
  {
    return 'Triv_forumbundle_forum_edit';
  }

  public function getParent()
  {
    return new ForumType();
  }
}