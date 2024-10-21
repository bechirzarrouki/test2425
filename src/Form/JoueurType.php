<?php

namespace App\Form;

use App\Entity\Joueur;
use App\Entity\Partie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JoueurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('status', CheckboxType::class, [
                'label' => 'Statut actif',
                'required' => false,
            ])
            ->add('PartieId', EntityType::class, [
                'class' => Partie::class, // Specify the related entity
                'choice_label' => 'nom', // Assume Partie has a 'nom' field
                'label' => 'Sélectionnez une partie',
                'placeholder' => 'Choisissez une partie', // Optional placeholder
                'required' => true,
            ])
            ->add('Submit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Joueur::class,
        ]);
    }
}
