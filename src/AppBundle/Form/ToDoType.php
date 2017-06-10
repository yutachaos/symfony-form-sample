<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type as InputType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraint as Custom;

class ToDoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('task',
                InputType\ChoiceType::class,
                [
                    'choices' => [
                        '1' => 'work',
                        '2' => 'hobby',
                    ],

                    'constraints' => [
                            new Assert\NotBlank(),
                        ],
                ]
            )
            ->add('memo',
                InputType\TextareaType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                        new Assert\Length(['min' => 2, 'max' => 255]),
                    ],
                ])
            ->add('date',
                InputType\TextType::class,
                [
                    'constraints' => [
                        new Custom\CheckDateFormat(),
                    ],
                ]);

        $entity = $builder->getData();

        if (!$entity->getId()) {
            $builder->add('Create', InputType\SubmitType::class,
                [
                    'attr' => [
                        'class' => 'btn btn-primary',
                    ],
                ]
            );
        } else {
            $builder->add('Edit', InputType\SubmitType::class,
            [
            'attr' => [
                'class' => 'btn btn-primary',
            ],
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ToDo',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_todo';
    }
}
