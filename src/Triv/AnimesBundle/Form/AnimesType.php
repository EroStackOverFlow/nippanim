<?php
// src/Triv/AnimesBundle/Form/AnimesType.php

namespace Triv\AnimesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnimesType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('image',      new AnimesImageType())
	  ->add('titre',   'text')
	  ->add('auteur',   'text')
	  ->add('datesortie',   'text') 
	  ->add('genre',   'text')
	  ->add('category', 'choice', array(
           'choices' => array(
           'Anime serie' => 'SERIES',
           'Films ou oav' => 'FILMS ET OAV',
		   'Critiques mangas' => 'CRITIQUES MANGAS'
           ),
			'required'    => false,
			'empty_value' => 'Choisissez cathegorie de video',
			'empty_data'  => null
		))
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
      'data_class' => 'Triv\AnimesBundle\Entity\Animes'
    ));
  }

  /**
   * @return string
   */
  public function getName()
  {
    return 'Triv_animesbundle_animes';
  }
}