<?php

namespace App\DataFixtures;

use App\Domain\Model\Product; 
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory; 
use Ramsey\Uuid\Uuid;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('es_ES'); // O el locale que prefieras, ej. 'en_US' para inglés

        // Crear 20 productos de ejemplo
        for ($i = 0; $i < 20; $i++) {
            // Genera un UUID para el ID (si tu campo id es string y length 36 como en tu XML)
            // Si es AUTO_INCREMENT, no pases el ID, Doctrine lo generará.
            $id = Uuid::uuid4()->toString();

            $product = new Product(
                $id,
                $faker->unique()->words(rand(2, 4), true), // Nombre de 2 a 4 palabras
                $faker->randomFloat(2, 10, 1000), // Precio entre 10.00 y 1000.00 con 2 decimales
                $faker->randomElement([5, 10, 21]) // Tasa de impuesto común
            );

            // Doctrine no persiste los objetos directamente a la DB en cada iteración
            // En su lugar, los pone en una cola
            $manager->persist($product);
        }

        // Una vez que todos los objetos están en la cola, Doctrine los guarda de una vez
        $manager->flush();

        echo "Se han cargado 20 productos falsos en la base de datos.\n";
    }
}