<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FibonacciSequenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lower_limit', DateTimeType::class, [
                'label' => 'Start Date',
                'data' => (new \DateTimeImmutable('first day of this month'))->setTime(00, 00, 00),
                'widget' => 'single_text',
                'with_seconds' => true,
            ])
            ->add('upper_limit', DateTimeType::class, [
                'label' => 'End Date',
                'data' => (new \DateTimeImmutable('last day of this month'))->setTime(23, 59, 59),
                'widget' => 'single_text',
                'with_seconds' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Send',
            ]);
    }
}
