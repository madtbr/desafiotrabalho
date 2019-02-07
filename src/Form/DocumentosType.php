<?php

namespace App\Form;

use App\Entity\Documentos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class DocumentosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('funcionario')
        ->add('imagem', FileType::class, [
            'label' => 'Selecione a imagem do doc:',
            'data_class' => null
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Documentos::class,
        ]);
    }
    
}
