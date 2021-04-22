<?php


namespace App\Traits;


trait ProductParseResponceTrait
{
    /**
     * @param $products
     * @return array
     */
    public function parse($products)
    {
        $parseData = [];

        foreach ($products as $product) {
            $parseData[] = [
                "sku" => $product["sku"],
                "name" => $product["name"],
                "category" => $product["category"],
                "price" => [
                    "original" => $product["price"],
                    "final" => $product["percentage"] ? $product["price"] - ($product["price"] * $product["percentage"] / 100) : $product["price"],
                    "discount_percentage" =>  $product["percentage"] ? "{$product["percentage"]}%" : null,
                    "currency" => "EUR"
                ]
            ];
        }
        return $parseData;
    }
}
