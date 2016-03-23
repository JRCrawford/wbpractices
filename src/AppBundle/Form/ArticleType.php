<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('summary', TextType::class)
            ->add('content', TextareaType::class, array(
                'attr' => array(
                    'rows' => '30',
                    'class' => 'tinymce',
                    'data-theme' => 'advanced',
                )
            ))
            ->add('slug', TextType::class)
            ->add('mainImage', TextType::class)
            ->add('category', TextType::class)
            ->add('titleColour', TextType::class)
            ->add('datePosted', DateType::class)
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Article'
        ));
    }
}