<?php

namespace App\DataFixtures;

use App\Entity\Supplier;
use App\Entity\Season;
use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // --- Créer des catégories ---
        $categories = [];

        $names = ['Robe', 'Chemise', 'Veste'];
        foreach ($names as $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
            $categories[$name] = $category;
        }

        // --- Créer des fournisseurs ---
        $zara = new Supplier();
        $zara->setName('Zara');
        $manager->persist($zara);

        $mango = new Supplier();
        $mango->setName('Mango');
        $manager->persist($mango);

        // --- Créer des collections ---
        $ete2024 = new Season();
        $ete2024->setName('Été 2024');
        $manager->persist($ete2024);

        $hiver2025 = new Season();
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
            ->setSeason($ete2024)
            ->setCategory($categories['Robe']);
        $manager->persist($product1);

        $product2 = new Product();
        $product2
            ->setName('Chemise lin')
            ->setColor('Blanc cassé')
            ->setPrice(45.00)
            ->setSize('L')
            ->setStatus('in_stock')
            ->setSupplier($mango)
            ->setSeason($ete2024)
            ->setCategory($categories['Chemise']);
        $manager->persist($product2);

        $product3 = new Product();
        $product3
            ->setName('Veste laine')
            ->setColor('Noir')
            ->setPrice(79.99)
            ->setSize('40')
            ->setStatus('in_stock')
            ->setSupplier($zara)
            ->setSeason($hiver2025)
            ->setCategory($categories['Veste']);
        $manager->persist($product3);

        // Enregistrement en base
        $manager->flush();
    }
}
