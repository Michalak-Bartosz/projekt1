<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', EntityType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-2xl outline-none',
                    'placeholder' => 'Enter Name...'
                ),
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => false,
            ])
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-2xl outline-none',
                    'placeholder' => 'Enter Name...'
                ),
                'label' => false,
                'required' => false
            ])
            ->add('date', DateTimeType::class, [
                'attr' => array(
                    'class' => 'bg-transparent inline-flex mt-10 border-b-2 w-full h-20 text-2xl outline-none',
                    'placeholder' => 'Enter Date...',
                    'input' => date('Y-m-d H:i:s')
                ),
                'years' => range(1970, date('Y')),
                'input' => "datetime",
                'label' => false
            ])
            ->add('description', TextareaType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block mt-10 border-b-2 w-full h-40 text-2xl outline-none',
                    'placeholder' => 'Enter Description...'
                ),
                'label' => false,
                'required' => false
            ])
            ->add('imagePath', FileType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block mt-10 border-b-2 w-full h-20 text-2xl outline-none',
                ),
                'required' => false,
                'mapped' => false,
                'label' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
