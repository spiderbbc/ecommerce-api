<?php

namespace App\Tests\Domain\Model;

use PHPUnit\Framework\TestCase;
use App\Domain\Model\Product;

class ProductTest extends TestCase
{
    public function testGetFinalPriceCalculatesCorrectly()
    {
        $product = new Product('1', 'Test', 100.0, 21); // 21% de impuesto
        $this->assertEquals(121.0, $product->getFinalPrice());

        $product = new Product('2', 'Test2', 50.0, 10); // 10% de impuesto
        $this->assertEquals(55.0, $product->getFinalPrice());

        $product = new Product('3', 'Test3', 0.0, 21); // precio 0
        $this->assertEquals(0.0, $product->getFinalPrice());

        $product = new Product('4', 'Test4', 99.99, 8); // decimales
        $this->assertEquals(107.99, $product->getFinalPrice());
    }
} 