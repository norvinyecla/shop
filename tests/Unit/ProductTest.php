<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * Create new product with no fields
     *
     * @return void
     */
    public function testCreateNewProductWithNoFields()
    {
        $data = [
            
        ];

        $response = $this->json('POST', '/api/add', $data);
        $response->assertStatus(422);
        $response->assertJsonStructure(
            [ 
                'errors' => [
                    'name',
                    'description',
                    'price',
                    'picture'
                ]
            ]
        );
    }

    /**
     * Create new product with complete fields
     *
     * @return void
     */
    public function testCreateNewProduct()
    {
        $data = [
            'name' => 'test name',
            'price' => 100,
            'description' => 'test description',
            'picture' => 'test'
        ];

        $response = $this->json('POST', '/api/add', $data);
        var_dump($response->json());
        $response->assertStatus(422);
    }
}
