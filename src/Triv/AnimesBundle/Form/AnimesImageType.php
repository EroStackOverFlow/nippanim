<?php
// src/Triv/AnimesBundle/Form/AnimesImageType.php

namespace Triv\AnimesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnimesImageType extends AbstractType
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
      'data_class' => 'Triv\AnimesBundle\Entity\AnimesImage'
    ));
  }

  public function getName()
  {
    return 'Triv_animesbundle_animesImage';
  }
}