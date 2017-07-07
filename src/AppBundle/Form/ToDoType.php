<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type as InputType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraint as Custom;

class ToDoType extends AbstractType
{

    const ARRAY_VALUE_KEY = 'type';

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'task',
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
            ->add(
                'type',
                InputType\ChoiceType::class,
                [
                    'choices' => array(
                        '1' => 'Hobby',
                        '2' => 'Work',
                        '3' => 'Study',
                    ),
                    'multiple' => true,
                    'expanded' => true,
                ]
            )
            ->add(
                'memo',
                InputType\TextareaType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                        new Assert\Length(['min' => 2, 'max' => 255]),
                    ],
                ]
            )
            ->add(
                'date',
                InputType\DateType::class
            );

        $entity = $builder->getData();

        if (!$entity->getId()) {
            $builder->add(
                'Create',
                InputType\SubmitType::class,
                [
                    'attr' => [
                        'class' => 'btn btn-primary',
                    ],
                ]
            );
        } else {
            $builder->add(
                'Edit',
                InputType\SubmitType::class,
                [
                    'attr' => [
                        'class' => 'btn btn-primary',
                    ],
                ]
            );
        }

        $builder
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                function (FormEvent $event) {
                    $form = $event->getForm();
                    $entity = $event->getData();
                    $convertedType = $this->convertValueToArr($entity->getType());
                    $entity->setType($convertedType);
                }
            )
            ->addEventListener(
                FormEvents::POST_SUBMIT,
                function (FormEvent $event) {
                    $entity = $event->getData();
                    $convertedType = $this->parseArrToStr($entity->getType());
                    $entity->setType($convertedType);
                }
            );
    }


    public function convertValueToArr($value)
    {
        return explode(',', $value);
    }

    public function parseArrToStr($type)
    {
        return implode(',', $type);

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\ToDo',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_todo';
    }
}
