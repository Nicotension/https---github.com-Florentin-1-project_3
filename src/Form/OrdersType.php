<?php

namespace App\Form;

use App\Entity\Orders;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('user_id')
            // ->add('product_id')
            // ->add('date_time', null, [
            //     'widget' => 'single_text',
            // ])

            ->add('quantity', null, ["attr" => ["placeholder" => "Please enter quantity","class" => "form-control", 'min'=> 1, 'max' => 100, ], 'data'=> 1] 
            
            
            )

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Orders::class,
        ]);
    }
}
