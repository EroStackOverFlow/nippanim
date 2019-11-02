<?php
// src/Triv/AnimesBundle/Form/CritiqueAnimesImageType.php

namespace Triv\AnimesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CritiqueAnimesImageType extends AbstractType
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
      'data_class' => 'Triv\AnimesBundle\Entity\CritiqueAnimesImage'
    ));
  }

  public function getName()
  {
    return 'Triv_animesbundle_animesImage';
  }
}