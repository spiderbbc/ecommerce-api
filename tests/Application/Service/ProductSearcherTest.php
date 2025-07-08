<?php

namespace App\Tests\Application\Service;

use PHPUnit\Framework\TestCase;
use App\Application\Service\ProductSearcher;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Model\Product;

class ProductSearcherTest extends TestCase
{
    public function testExecuteReturnsProductsAndTotal()
    {
        $mockRepo = $this->createMock(ProductRepositoryInterface::class);
        $mockRepo->method('search')->willReturn([
            new Product('1', 'Test', 10.0, 21)
        ]);
        $mockRepo->method('countByFilter')->willReturn(1);

        $searcher = new ProductSearcher($mockRepo);
        $result = $searcher->execute('Test', 1, 10);

        $this->assertCount(1, $result['products']);
        $this->assertEquals(1, $result['total']);
        $this->assertInstanceOf(Product::class, $result['products'][0]);
    }
}