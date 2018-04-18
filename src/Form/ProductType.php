<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,
                ['attr' => ['class' => 'form-control'], 'error_bubbling' => true])
            ->add('price', NumberType::class,
                ['attr' => ['class' => 'form-control'], 'error_bubbling' => true, "invalid_message" => "Price is not valid!"])
            ->add('quantity', NumberType::class,
                ['attr' => ['class' => 'form-control'], 'error_bubbling' => true, "invalid_message" => "Quanitity is not valid!"])
            ->add('status', ChoiceType::class,
                ['attr' => ['class' => 'form-control'], 'error_bubbling' => true, 'choices' => ['Available' => 'available', 'Unavailable' => "unavailable"], "invalid_message" => "Choose a valid option!"]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Product::class);
    }


}