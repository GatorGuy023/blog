<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\CustomerContact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Customer Name'
            ])
            ->add('customerContacts', CollectionType::class, [
                'required' => false,
                'entry_type' => CustomerContactType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'label' => 'Customer Contacts',
                'by_reference' => false,
                'error_bubbling' => false,
                'entry_options' => [
                    'empty_data' => new CustomerContact(),
                    'by_reference' => false
                ]
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
