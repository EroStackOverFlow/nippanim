<?php
// src/Triv/AnimesBundle/Form/CritiqueEpisodesType
namespace Triv\AnimesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CritiqueEpisodesType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('title', 'text')
	  ->add('type', 'text')
      ->add('src', 'text')
	  ->add('ajouter', 'submit')
	  ->add('effacer', 'reset')
	;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Triv\AnimesBundle\Entity\CritiqueEpisodes'
    ));
  }

  public function getName()
  {
    return 'Triv_animesbundle_critiqueepisodes';
  }
}