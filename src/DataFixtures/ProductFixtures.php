<?php

namespace App\DataFixtures;

use App\Domain\Model\Product; 
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory; 
use Ramsey\Uuid\Uuid;

class ProductFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('es_ES');

        // Crear 20 productos de ejemplo
        for ($i = 0; $i < 20; $i++) {
            $id = Uuid::uuid4()->toString();

            $product = new Product(
                $id,
                $faker->unique()->words(rand(2, 4), true), // Nombre de 2 a 4 palabras
                $faker->randomFloat(2, 10, 1000), // Precio entre 10.00 y 1000.00 con 2 decimales
                $faker->randomElement([4, 10, 21]) // Tasa de impuesto común
            );

            $manager->persist($product);
        }

        $manager->flush();

        echo "Se han cargado 20 productos falsos en la base de datos.\n";
    }
}