<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Theater;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameShow',TextType::class, [
                'label' => "Titre de l'article"
            ])
            ->add('createdOn')
            ->add('visible')
            ->add('author')
            ->add('summaryShow')
            ->add('img')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name'
                            ])
            // ->add('theaters', EntityType::class, [
            //     'class' => Theater::class,
            //     'choice_label' => 'name'
            //                 ])
            
            ->add('Save', SubmitType::class, []);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
