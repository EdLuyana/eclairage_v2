<?php

namespace App\DataFixtures;

use App\Entity\Supplier;
use App\Entity\Collection;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // --- Créer des fournisseurs ---
        $zara = new Supplier();
        $zara->setName('Zara');
        $manager->persist($zara);

        $mango = new Supplier();
        $mango->setName('Mango');
        $manager->persist($mango);

        // --- Créer des collections ---
        $ete2024 = new Collection();
        $ete2024->setName('Été 2024');
        $manager->persist($ete2024);

        $hiver2025 = new Collection();
        $hiver2025->setName('Hiver 2025');
        $manager->persist($hiver2025);

        // --- Créer quelques produits ---
        $product1 = new Product();
        $product1
            ->setName('Robe fluide')
            ->setColor('Bleu ciel')
            ->setPrice(39.99)
            ->setSize('M')
            ->setStatus('to_integrate')
            ->setSupplier($zara)
            ->setCollection($ete2024);
        $manager->persist($product1);

        $product2 = new Product();
        $product2
            ->setName('Chemise lin')
            ->setColor('Blanc cassé')
            ->setPrice(45.00)
            ->setSize('L')
            ->setStatus('in_stock')
            ->setSupplier($mango)
            ->setCollection($ete2024);
        $manager->persist($product2);

        $product3 = new Product();
        $product3
            ->setName('Veste laine')
            ->setColor('Noir')
            ->setPrice(79.99)
            ->setSize('40')
            ->setStatus('in_stock')
            ->setSupplier($zara)
            ->setCollection($hiver2025);
        $manager->persist($product3);

        // Enregistrement en base
        $manager->flush();
    }
}
