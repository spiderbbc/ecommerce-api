<?php

namespace App\Application\Service;

use App\Domain\Model\Product;

interface CreateProductUseCase
{
    /**
     * Executes the use case to create a new product.
     *
     * @param string $name The name of the product.
     * @param float $price The price of the product.
     * @param int $taxRate The tax rate applicable to the product.
     *
     * @return Product The created product instance.
     */
    public function execute(string $name, float $price, int $taxRate): Product;
}