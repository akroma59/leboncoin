<?php

namespace App\Form;

use App\Entity\Ads;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
            ->add('title', TextType::class, [
                'label' => "Ad title"
            ])
            
            ->add('price', NumberType::class, [
                'label' => "Ad price"
            ])

            ->add('description', TextareaType::class, [
                'label' => "Ad description"
            ])
            
            ->add('state', ChoiceType::class, [
                'label' => "Ad state"
            ])
            
            ->add('category', ChoiceType::class, [
                'label' => "Ad category"
            ])
            
            ->add('location', AddressType::class, [
                'label' => "Ad location"
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ads::class,
        ]);
    }
}
