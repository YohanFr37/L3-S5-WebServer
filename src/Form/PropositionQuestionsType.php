<?php

namespace App\Form;

use App\Entity\PropositionQuestions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropositionQuestionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', ChoiceType::class, [
                'choices'  => [
                    'Entertainment' => [
                        'Books' => 'Entertainment: Books',
                        'Films' => 'Entertainment: Films',
                        'Music' => 'Entertainment: Music',
                        'Musicals & Theatres' => 'Entertainment: Musicals & Theatres',
                        'Television' => 'Entertainment: Television',
                        'Video Games' => 'Entertainment: Video Games',
                        'Board Games' => 'Entertainment: Board Games',
                        'Japanese Anime & Manga' => 'Entertainment: Japanese Anime & Manga',
                        'Cartoon & Animations' => 'Entertainment: Cartoon & Animations',
                        'Comics' => 'Entertainment: Comics',
                    ],
                    'Science' => [
                        'Science & Nature' => 'Science & Nature',
                        'Computers' => 'Science: Computers',
                        'Mathematics' => 'Science: Mathematics',
                        'Gadgets' => 'Science: Gadgets',
                    ],
                    'Autres' => [
                        'General Knowledge' => 'General Knowledge',
                        'Mythology' => 'Mythology',
                        'Sports' => 'Sports',
                        'History' => 'History',
                        'Politics' => 'Politics',
                        'Art' => 'Art',
                        'Celebrities' => 'Celebrities',
                        'Animals' => 'Animals',
                        'Vehicles' => 'Vehicles',
                    ],
                ],
            ])
            ->add('difficulty', ChoiceType::class, [
                'choices'  => [
                    'Facile' => 0,
                    'Normale' => 1,
                    'Difficile' => 2,
                ],
            ])
            ->add('question', TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('correct_answer', TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('incorrect0', TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('incorrect1',TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('incorrect2',TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropositionQuestions::class,
        ]);
    }
}