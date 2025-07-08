<?php

namespace App\Application\Service;

use App\Domain\Repository\ProductRepositoryInterface;

class ProductSearcher implements SearchProductsUseCase
{
    private ProductRepositoryInterface $productRepository;

    /**
     * ProductSearcher constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Executes the use case to search for products.
     *
     * @param string|null $name The name of the product to search for.
     * @param int $page The page number for pagination.
     * @param int $limit The number of products per page.
     *
     * @return array An array containing the products and total count.
     */
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