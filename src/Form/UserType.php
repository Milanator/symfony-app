<?php

    namespace App\Form;

    use Symfony\Component\Form\Extension\Core\Type\DateType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;

    class UserType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('description', TextType::class)
                ->add('dateTime', DateType::class)
                ->add('isDone', CheckboxType::class, [
                    'required' => false
                ])
                ->add('save', SubmitType::class, ['label' => 'Save item'])
            ;
        }
    }