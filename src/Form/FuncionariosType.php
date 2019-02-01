<?php

namespace App\Form;

use App\Entity\Funcionarios;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FuncionariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('tipo', ChoiceType::class, array(
                'choices'  => array(
                    'Estatutário'    => 1,
                    'Comissionado' => 0
                )))
            ->add('status', ChoiceType::class, array(
                'choices'  => array(
                    'Ativo'    =>1,
                    'Inativo' =>0
                )))
            
            /*->add('secretaria');
           
           da erro se colocar desse modo*/
           
           ->add('secretaria', EntityType::class, [
                'class' => 'App\Entity\Secretarias',
                'choice_label' => 'nome',
                'placeholder' => 'Selecione',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])                              
        ;
        $builder->add('salario' , SalariosType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Funcionarios::class
        ]);
    }
}
