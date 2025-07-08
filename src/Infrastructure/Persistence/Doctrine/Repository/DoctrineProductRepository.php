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

    /**
     * @param Product $product
     */
    public function save(Product $product): void
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();
    }


    /**
     * @param string|null $name
     * @param int $page
     * @param int $limit
     * @return Product[]
     */
    public function search(?string $name, int $page, int $limit): array
    {
        $qb = $this->createQueryBuilder('p');
        if ($name !== null && $name !== '') {
            $qb->andWhere('LOWER(p.name) LIKE :name')
               ->setParameter('name', '%' . strtolower($name) . '%');
        }
        $qb->setFirstResult(($page - 1) * $limit)
           ->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }

    /**
     * @param string|null $name
     * @return int
     */
    public function countByFilter(?string $name): int
    {
        $qb = $this->createQueryBuilder('p')
            ->select('COUNT(p.id)');
        if ($name !== null && $name !== '') {
            $qb->andWhere('LOWER(p.name) LIKE :name')
               ->setParameter('name', '%' . strtolower($name) . '%');
        }
        return (int) $qb->getQuery()->getSingleScalarResult();
    }
}