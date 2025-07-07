<?php

namespace App\Domain\Repository;

use App\Domain\Model\Product;

interface ProductRepositoryInterface
{
    public function save(Product $product): void;
    public function findAll(): array;
}