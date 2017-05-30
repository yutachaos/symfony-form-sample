<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type as InputType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints;

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
                        '2' => 'hobby'
                    ],

                    'constraints' =>
                        [
                            new Constraints\NotBlank()
                        ]
                ]
            )
            ->add('memo',
                InputType\TextareaType::class,
                [
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\Length(['max' => 255])
                    ]
                ]);

        $entity = $builder->getData();

        if(!$entity->getId()){
            $builder->add('Create', InputType\SubmitType::class,
                [
                    'attr' => [
                        'class' => 'btn btn-primary'
                    ]
                ]
            );
        }else{
            $builder->add('Edit', InputType\SubmitType::class,
            [
            'attr' => [
                'class' => 'btn btn-primary'
            ]
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
            'data_class' => 'AppBundle\Entity\ToDo'
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
