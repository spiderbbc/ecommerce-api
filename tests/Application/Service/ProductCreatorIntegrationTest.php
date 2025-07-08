<?php

namespace App\Tests\Application\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Application\Service\ProductCreator;
use App\Domain\Repository\ProductRepositoryInterface;

class ProductCreatorIntegrationTest extends KernelTestCase
{
    public function testExecuteSavesProductInDatabase()
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var ProductRepositoryInterface $repo */
        $repo = $container->get(ProductRepositoryInterface::class);
        $creator = new ProductCreator($repo);

        $creator->execute('Producto DB', 50.0, 21);

        $found = $repo->search('Producto DB', 1, 1);
        $this->assertNotEmpty($found);
        $this->assertEquals('Producto DB', $found[0]->getName());
        $this->assertEquals(50.0, $found[0]->getPrice());
        $this->assertEquals(21, $found[0]->getTaxRate());
    }
} 