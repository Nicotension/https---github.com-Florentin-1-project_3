<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('availability', ChoiceType::class, ["choices" => ["-Select Status-" => ["Available" => "Available", "Not Available" => "Not Available"]], "attr" => ["class" => "form-control"]])
            ->add('picture')
            ->add('category', ChoiceType::class, ["choices" => ["-Select Category-" => ["Outdoor toy" => "Outdoor toy", "Puppets" => "Puppets", "Boardgames" => "Boardgames", "Infants" => "Infants", "Craft And Arts" => "Craft And Arts", "Construction" => "Construction"]], "attr" => ["class" => "form-control"]])
            ->add('description',)

            ->add('picture', FileType::class, [
                'label' => 'Picture (img, jpg, jpeg file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using attributes
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '3024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
