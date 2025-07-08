<?php

namespace App\Application\Service;

use App\Domain\Model\Product;
use App\Application\Service\CreateProductUseCase;
use App\Domain\Repository\ProductRepositoryInterface;

use Ramsey\Uuid\Uuid;

class ProductCreator implements CreateProductUseCase
{
    private ProductRepositoryInterface $productRepository;
    
    /**
     * ProductCreator constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Executes the use case to create a new product.
     *
     * @param string $name The name of the product.
     * @param float $price The price of the product.
     * @param int $taxRate The tax rate applicable to the product.
     *
     * @return Product The created product instance.
     */
    public function execute(string $name, float $price, int $taxRate): Product
    {
        $id = Uuid::uuid4()->toString();

        $product = new Product($id, $name, $price, $taxRate);
        $this->productRepository->save($product);

        return $product;
    }
}