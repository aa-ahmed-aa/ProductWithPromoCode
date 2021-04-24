<?php


namespace App\Tests\Unit;

use App\Traits\ProductParseResponseTrait;
use PHPUnit\Framework\TestCase;

final class ProductParseTest extends TestCase
{
    public function test_has_price_is_array(): void
    {
        $mock = $this->getMockForTrait(ProductParseResponseTrait::class);

        $products[] = [
            "sku" => "00004",
            "name" => "product name 1",
            "category" => "boots",
            "price" => 154,
            "percentage" => 30
        ];

        $this->assertIsArray($mock->parse($products));
        $this->assertTrue(is_array($mock->parse($products)[0]['price']));
    }
}
