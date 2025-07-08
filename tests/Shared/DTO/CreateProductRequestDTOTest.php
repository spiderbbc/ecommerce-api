<?php

namespace App\Tests\Shared\DTO;

use PHPUnit\Framework\TestCase;
use App\Shared\DTO\CreateProductRequestDTO;

class CreateProductRequestDTOTest extends TestCase
{
    public function testValidDataCreatesDTO()
    {
        $data = ['name' => 'Producto', 'price' => 10.5, 'taxRate' => 21];
        $dto = new CreateProductRequestDTO($data);
        $this->assertEquals('Producto', $dto->name);
        $this->assertEquals(10.5, $dto->price);
        $this->assertEquals(21, $dto->taxRate);
    }

    public function testNameIsRequiredAndMustBeString()
    {
        $this->expectException(\InvalidArgumentException::class);
        new CreateProductRequestDTO(['price' => 10, 'taxRate' => 21]);

        $this->expectException(\InvalidArgumentException::class);
        new CreateProductRequestDTO(['name' => 123, 'price' => 10, 'taxRate' => 21]);
    }

    public function testPriceIsRequiredAndMustBeNumeric()
    {
        $this->expectException(\InvalidArgumentException::class);
        new CreateProductRequestDTO(['name' => 'Producto', 'taxRate' => 21]);

        $this->expectException(\InvalidArgumentException::class);
        new CreateProductRequestDTO(['name' => 'Producto', 'price' => 'abc', 'taxRate' => 21]);
    }

    public function testPriceCannotBeNegative()
    {
        $this->expectException(\InvalidArgumentException::class);
        new CreateProductRequestDTO(['name' => 'Producto', 'price' => -5, 'taxRate' => 21]);
    }

    public function testTaxRateIsRequiredAndMustBeNumeric()
    {
        $this->expectException(\InvalidArgumentException::class);
        new CreateProductRequestDTO(['name' => 'Producto', 'price' => 10]);

        $this->expectException(\InvalidArgumentException::class);
        new CreateProductRequestDTO(['name' => 'Producto', 'price' => 10, 'taxRate' => 'abc']);
    }

    public function testTaxRateMustBeAllowedValue()
    {
        $this->expectException(\InvalidArgumentException::class);
        new CreateProductRequestDTO(['name' => 'Producto', 'price' => 10, 'taxRate' => 15]);
    }

    public function testTaxRateMustBeInteger()
    {
        $this->expectException(\InvalidArgumentException::class);
        new CreateProductRequestDTO(['name' => 'Producto', 'price' => 10, 'taxRate' => 10.5]);
    }

    public function testTaxRateCannotBeNegative()
    {
        $this->expectException(\InvalidArgumentException::class);
        new CreateProductRequestDTO(['name' => 'Producto', 'price' => 10, 'taxRate' => -4]);
    }
} 