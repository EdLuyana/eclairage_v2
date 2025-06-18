<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Supplier;
use App\Entity\Season;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du produit',
            ])
            ->add('color', TextType::class, [
                'label' => 'Couleur',
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix',
                'currency' => 'EUR',
            ])
            ->add('size', TextType::class, [
                'label' => 'Taille (ex : 36, M, L, U)',
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'À intégrer' => 'to_integrate',
                    'En stock' => 'in_stock',
                ],
            ])
            ->add('supplier', EntityType::class, [
                'label' => 'Fournisseur',
                'class' => Supplier::class,
                'choice_label' => 'name',
            ])
            ->add('season', EntityType::class, [
                'label' => 'Collection',
                'class' => Season::class,
                'choice_label' => 'name',
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie',
                'class' => Category::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
