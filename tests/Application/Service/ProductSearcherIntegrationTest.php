<?php

namespace App\Tests\Application\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Application\Service\ProductSearcher;
use App\Domain\Repository\ProductRepositoryInterface;

class ProductSearcherIntegrationTest extends KernelTestCase
{
    /**
     * Test that the ProductSearcher service can be instantiated and returns products.
     */
    public function testExecuteWithRealRepository()
    {
        self::bootKernel();
        $container = static::getContainer();

        $repo = $container->get(ProductRepositoryInterface::class);
        $searcher = new ProductSearcher($repo);

        $result = $searcher->execute(null, 1, 10);
        $this->assertIsArray($result['products']);
        $this->assertIsInt($result['total']);
    }
}