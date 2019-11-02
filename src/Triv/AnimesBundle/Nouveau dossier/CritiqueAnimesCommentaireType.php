<?php

namespace Triv\AnimesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CritiqueAnimesCommentaireType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content',   'text')
			->add('Poster',      'submit')
	        ->add('Effacer',      'reset')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Triv\AnimesBundle\Entity\CritiqueAnimesCommentaire'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'triv_animesbundle_critiquesanimescommentaire';
    }
}
