<?php

namespace App\Shared\DTO;

class PaginatedResponseDTO
{
    /**
     * PaginatedResponseDTO constructor.
     *
     * @param array $items
     * @param int $totalItems
     * @param int $page
     * @param int $limit
     */
    public function __construct(
        public array $items,
        public int $totalItems,
        public int $page,
        public int $limit
    ) {}

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'data' => $this->items,
            'pagination' => [
                'total_items' => $this->totalItems,
                'page' => $this->page,
                'limit' => $this->limit,
                'total_pages' => (int) ceil($this->totalItems / $this->limit),
            ],
        ];
    }
}
