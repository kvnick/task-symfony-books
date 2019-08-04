<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Unique;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'book.name',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 2])
                ],
            ])
            ->add('isbn', TextType::class, [
                'label' => 'book.isbn',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 13, 'max' => 13]),
                ]
            ])
            ->add('year', IntegerType::class, [
                'label' => 'book.year',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 1, 'max' => 4])
                ]
            ])
            ->add('count', IntegerType::class, [
                'label' => 'book.count',
                'required' => false
            ])
            ->add('author', EntityType::class, [
                'label' => 'book.author',
                'required' => true,
                'class' => Author::class,
                'choice_label' => 'fullname',
                'expanded' => false,
                'multiple' => false,
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('cover', FileType::class, [
                'label' => 'book.cover',
                'mapped' => false,
                'error_bubbling' => true,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10Mi',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ]
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
