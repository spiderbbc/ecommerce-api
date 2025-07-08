<?php

namespace App\Domain\Repository;

use App\Domain\Model\Product;

interface ProductRepositoryInterface
{
    
    public function save(Product $product): void;
    /**
     * @param string|null $name 
     * @param int $page 
     * @param int $limit 
     * @return Product[]
     */
    public function search(?string $name, int $page, int $limit): array;

    /**
     * 
     * @param string|null $name
     * @return int
     */
    public function countByFilter(?string $name): int;
}