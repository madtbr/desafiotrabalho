<?php

namespace App\Form;

use App\Entity\Funcionarios;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
            // ->add('data_admissao', EntityType::class, [
            //     'class' => 'App\Entity\Funcionarios',
            //     'label' => "Data Admissao",
            //     'format' => 'dd-MM-yyyy',
            //     'widget' => 'choice'
            // ])                              
            ->add('data_admissao', DateType::class, [
                
                'label' => "Data Admissao",
                'format' => 'dd / MM / yyyy',
                'widget' => 'choice'
            ]);                             
        
        $builder->add('salario' , SalariosType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Funcionarios::class
        ]);
    }
}
