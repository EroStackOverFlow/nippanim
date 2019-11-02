<?php
// src/Triv/AnimesBundle/Form/CritiqueAnimesType.php

namespace Triv\AnimesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CritiqueAnimesType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('image',      new AnimesImageType())
	  ->add('titre',   'text')
	  ->add('auteur',   'text')
	  ->add('datesortie',   'text') 
	  ->add('genre',   'text') 
      ->add('synopsi',   'textarea')
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
      'data_class' => 'Triv\AnimesBundle\Entity\CritiqueAnimes'
    ));
  }

  /**
   * @return string
   */
  public function getName()
  {
    return 'Triv_animesbundle_critiqueanimes';
  }
}