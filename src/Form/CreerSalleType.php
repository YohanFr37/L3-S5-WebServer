<?php

namespace App\Form;

use App\Entity\Questions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreerSalleType extends AbstractType
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
                        'Television' => 'Entertainment: Television',
                        'Video Games' => 'Entertainment: Video Games',
                        'Board Games' => 'Entertainment: Board Games',
                        'Comics' => 'Entertainment: Comics',
                    ],
                    'Science' => [
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
            ;
        }
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => Questions::class,
            ]);
        }
}