<?php

namespace  App\Domain\Model;

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

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getTax(): int
    {
        return $this->tax;
    }

    public function changeName(string $name): void
    {
        $this->name = $name;
    }

    public function changePrice(float $price): void
    {
        $this->price = $price;
    }

    public function changeTax(int $taxRate): void
    {
        $this->taxRate = $taxRate;
    }

    public function getFinalPrice(): float
    {
        return $this->price * (1 + $this->taxRate);
    }


}