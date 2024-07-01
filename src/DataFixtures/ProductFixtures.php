<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $products = [
            ['name' => 'Apple iPhone 14', 'price' => 4999.99],
            ['name' => 'Samsung Galaxy S23', 'price' => 3899.99],
            ['name' => 'Apple AirPods Pro', 'price' => 1099.99],
            ['name' => 'Dell XPS 13 Laptop', 'price' => 6999.99],
            ['name' => 'Apple MacBook Air M2', 'price' => 6499.99],
            ['name' => 'Samsung 4K UHD TV 55"', 'price' => 2999.99],
            ['name' => 'Sony PlayStation 5', 'price' => 2999.99],
            ['name' => 'Xbox Series X', 'price' => 2499.99],
            ['name' => 'GoPro HERO10 Black', 'price' => 2399.99],
            ['name' => 'Amazon Kindle Paperwhite', 'price' => 699.99],
        ];
        foreach ($products as $productData) {
            $product = new Product();
            $product->setName($productData['name']);
            $product->setPrice($productData['price']);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
