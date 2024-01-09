<?php

namespace Tests\Unit;

use Tests\TestCase;

class ProductTest extends TestCase
{
    private $baseData = [
        'name' => "Product 1",
        'description' => "Product 1 desc",
        'price' => 567,
        'image' => 'https://placehold.co/600x400',
        'categories' => []
    ];

    public function test_ability_to_create_a_product(): void
    {
        $body = $this->baseData;

        $response = $this->postJson(route('products.store'), $body);
        $response->assertCreated();

        unset($body['categories']);

        $response->assertJson($body);
    }

    public function test_inability_to_create_a_product_with_wrong_category(): void
    {
        $body = $this->baseData;
        $body['categories'] = [300]; // doesn't exists. 

        $response = $this->postJson(route('products.store'), $body);
        $response->assertStatus(422);
    }

    public function test_inability_to_create_a_product_with_negative_price(): void
    {
        $body = $this->baseData;
        $body['price'] = -80;

        $response = $this->postJson(route('products.store'), $body);
        $response->assertStatus(422);
    }
}
