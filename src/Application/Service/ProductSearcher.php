<?php

namespace App\Application\Service;

use App\Domain\Repository\ProductRepositoryInterface;

class ProductSearcher implements SearchProductsUseCase
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(?string $name, int $page, int $limit): array
    {
        $products = $this->productRepository->search($name, $page, $limit);
        $total = $this->productRepository->countByFilter($name);

        return [
            'products' => $products,
            'total' => $total,
        ];
    }
}