<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-2xl outline-none',
                    'placeholder' => 'Enter Name...'
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
            ])
            ->add('color', ColorType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block mt-10 border-b-2 w-20 h-20 text-2xl outline-none',
                ),
                'required' => false,
                'mapped' => false,
                'label' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
