<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Review;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextareaType::class, [
            'attr' => ['placeholder' => 'Write your review here'],
            'label' => 'Send us your feedbacks',
        ]);
            /*->add('fk_user_id', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('fk_product_id', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'id',
            ])
        ;*/
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
