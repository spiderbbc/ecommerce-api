<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Model\Product;
use App\Domain\Repository\ProductRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class DoctrineProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $product): void
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();
    }


    public function findAll(): array
    {
        // Esto devolverá un array de objetos Product
        $products = parent::findAll();

        // Puedes añadir lógica adicional aquí, por ejemplo:
        // usort($products, fn($a, $b) => $a->getName() <=> $b->getName());

        return $products;
    }

}