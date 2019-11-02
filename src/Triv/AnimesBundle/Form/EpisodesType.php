<?php
// src/Triv/AnimesBundle/Form/EpisodesType
namespace Triv\AnimesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EpisodesType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('title', 'text')
      ->add('src', 'text')
	  ->add('epversion', 'text')
	  ->add('ajouter', 'submit')
	  ->add('effacer', 'reset')
	;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Triv\AnimesBundle\Entity\Episodes'
    ));
  }

  public function getName()
  {
    return 'Triv_animesbundle_episodes';
  }
}