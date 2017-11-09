<?php

namespace Coloc\MoviesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class ChoicesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('targetDate', DateType::class, array(
            'widget' => 'single_text',
            'label' => 'Date'
        ))->add('filmId', HiddenType::class, array(
            'attr' => ['class' => 'searchFilm'],
        ))->add('filmTitle', TextType::class, [
            'label' => 'Recherche du film',
            'mapped' => false,
            'attr' => ['onchange'=>"searchFilm(this)"],
        ])->add('user');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Coloc\MoviesBundle\Entity\Choice'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'coloc_moviesbundle_choice';
    }


}
