<?php

namespace App\Application\Service;

use App\Domain\Model\Product;

interface CreateProductUseCase
{
    public function execute(string $name, float $price): Product;
}