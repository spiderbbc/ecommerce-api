<?php

namespace App\Application\Service;

use App\Domain\Model\Product;

interface SearchProductsUseCase
{
    /**
     * @param string|null $name
     * @param int $page
     * @param int $limit
     * @return array{products: Product[], total: int}
     */
    public function execute(?string $name, int $page, int $limit): array;
}