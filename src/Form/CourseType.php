<?php

namespace App\Form;

use App\Entity\Course;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name", TextType::class, ["label" => " "])
            ->add("classement1", TextType::class, ["label" => "Position 1 + temps + tir"])
            ->add("classement2", TextType::class, ["label" => "Position 2 + temps + tir"])
            ->add("classement3", TextType::class, ["label" => "Position 3 + temps + tir"])
            ->add("classement4", TextType::class, ["label" => "Position 4 + temps + tir"])
            ->add("classement5", TextType::class, ["label" => "Position 5 + temps + tir"])
            ->add("classement6", TextType::class, ["label" => "Position 6 + temps + tir"])
            ->add("classement7", TextType::class, ["label" => "Position 7 + temps + tir"])
            ->add("classement8", TextType::class, ["label" => "Position 8 + temps + tir"])
            ->add("classement9", TextType::class, ["label" => "Position 9 + temps + tir"])
            ->add("classement10", TextType::class, ["label" => "Position 10 + temps + tir"])
            ->add("image", FileType::class, [
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        //'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Course::class
        ]);
    }
}
