<?php

namespace App\Application\Service;

use App\Domain\Model\Product;
use App\Application\Service\CreateProductUseCase;
use App\Domain\Repository\ProductRepositoryInterface;
use Ramsey\Uuid\Uuid;

class ProductCreator implements CreateProductUseCase
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(string $name, float $price): Product
    {
        $id = Uuid::uuid4()->toString();
        $product = new Product($id, $name, $price,10);
        $this->productRepository->save($product);

        return $product;
    }
}