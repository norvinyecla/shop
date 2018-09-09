<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * Test product index
     *
     * @return void
     */
    public function testProductIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test product create page
     *
     * @return void
     */
    public function testProductCreate()
    {
        $response = $this->get('/create');
        $response->assertStatus(200);
    }

    /**
     * Test product edit page
     *
     * @return void
     */
    public function testProductEdit()
    {
        $response = $this->get('/edit/12345');
        $response->assertStatus(404);
    }

    /**
     * Test product details page
     *
     * @return void
     */
    public function testProductDetails()
    {
        $response = $this->get('/details/67890');
        $response->assertStatus(404);
    }
}
