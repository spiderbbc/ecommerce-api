<?php

namespace  App\Domain\Model;

/**
 * @package App\Domain\Model
 */
class Product
{
    private ?string $id;
    private string $name;
    private float $price;
    private int $taxRate;

    
    public function __construct(?string $id, string $name, float $price, int $taxRate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->taxRate = $taxRate;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getTaxRate(): int
    {
        return $this->taxRate;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param float $price
     * @return void
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @param int $taxRate
     * @return void
     */
    public function setTaxRate(int $taxRate): void
    {
        $this->taxRate = $taxRate;
    }

    /**
     * Calculate the final price including tax.
     *
     * @return float
     */
    public function getFinalPrice(): float
    {
        return $this->price * (1 + $this->taxRate);
    }
}