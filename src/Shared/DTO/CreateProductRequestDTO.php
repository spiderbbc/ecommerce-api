<?php
namespace App\Application\DTO;

class CreateProductRequestDTO
{
    public string $name;
    public float $price;
    public int $taxRate;

    public function __construct(array $data)
    {
        if (empty($data['name']) || !is_string($data['name'])) {
            throw new \InvalidArgumentException('El nombre es obligatorio y debe ser una cadena.');
        }

        if (!isset($data['price']) || !is_numeric($data['price'])) {
            throw new \InvalidArgumentException('El precio es obligatorio y debe ser numérico.');
        }
        if ($data['price'] < 0) {
            throw new \InvalidArgumentException('El precio no puede ser negativo.');
        }

        if (!isset($data['taxRate']) || !is_numeric($data['taxRate'])) {
            throw new \InvalidArgumentException('El impuesto es obligatorio y debe ser numérico.');
        }

        if (intval($data['taxRate']) != $data['taxRate']) {
            throw new \InvalidArgumentException('El impuesto debe ser un número entero.');
        }
        
        if ($data['taxRate'] < 0) {
            throw new \InvalidArgumentException('El impuesto no puede ser negativo.');
        }

        $this->name = $data['name'];
        $this->price = (float) $data['price'];
        $this->taxRate = (int) $data['taxRate'];
    }
}