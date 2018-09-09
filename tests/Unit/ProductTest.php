<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
     * Create new product with a string as an image
     *
     * @return void
     */
    public function testCreateNewProductInvalidPicture()
    {
        $data = [
            'name' => 'test name',
            'price' => 100,
            'description' => 'test description',
            'picture' => 'test'
        ];

        $response = $this->json('POST', '/api/add', $data);
        $response->assertStatus(422);
    }

    /**
     * Create new product with an empty description
     *
     * @return void
     */
    public function testCreateNewProductEmptyDescription()
    {
        $file = UploadedFile::fake()->image('product.jpg');

        $data = [
            'name' => 'test name',
            'price' => 100,
            'description' => ' ',
            'picture' => $file
        ];

        $response = $this->json('POST', '/api/add', $data);
        $response->assertStatus(422);
    }

    /**
     * Create new product with an empty name
     *
     * @return void
     */
    public function testCreateNewProductEmptyName()
    {
        $file = UploadedFile::fake()->image('product.jpg');

        $data = [
            'name' => ' ',
            'price' => 100,
            'description' => 'test description',
            'picture' => $file
        ];

        $response = $this->json('POST', '/api/add', $data);
        $response->assertStatus(422);
    }

    /**
     * Create new product with invalid image (bmp)
     *
     * @return void
     */
    public function testCreateNewProductWithBMPImage()
    {
        Storage::fake('uploads');

        $file = UploadedFile::fake()->image('product.bmp');

        $data = [
            'name' => 'test name',
            'price' => 100,
            'description' => 'test description',
            'picture' => $file
        ];

        $response = $this->json('POST', '/api/add', $data);
        $response->assertStatus(422);
    }

    /**
     * Create new product with invalid image (svg)
     *
     * @return void
     */
    public function testCreateNewProductWithSVGImage()
    {
        Storage::fake('uploads');

        $file = UploadedFile::fake()->image('product.svg');

        $data = [
            'name' => 'test name',
            'price' => 100,
            'description' => 'test description',
            'picture' => $file
        ];

        $response = $this->json('POST', '/api/add', $data);
        $response->assertStatus(422);
    }

    /**
     * Create new product with valid image (jpeg)
     *
     * @return void
     */
    public function testCreateNewProductWithJPEGImage()
    {
        Storage::fake('uploads');

        $file = UploadedFile::fake()->image('product.jpeg');

        $data = [
            'name' => 'test name',
            'price' => 100,
            'description' => 'test description',
            'picture' => $file
        ];

        $response = $this->json('POST', '/api/add', $data);
        $response->assertStatus(200);
    }

    /**
     * Create new product with valid image (jpg)
     *
     * @return void
     */
    public function testCreateNewProductWithJPGImage()
    {
        Storage::fake('uploads');

        $file = UploadedFile::fake()->image('product.jpg');

        $data = [
            'name' => 'test name',
            'price' => 100,
            'description' => 'test description',
            'picture' => $file
        ];

        $response = $this->json('POST', '/api/add', $data);
        $response->assertStatus(200);
    }

    /**
     * Create new product with valid image (gif)
     *
     * @return void
     */
    public function testCreateNewProductWithGIFImage()
    {
        Storage::fake('uploads');

        $file = UploadedFile::fake()->image('product.gif');

        $data = [
            'name' => 'test name',
            'price' => 100,
            'description' => 'test description',
            'picture' => $file
        ];

        $response = $this->json('POST', '/api/add', $data);
        $response->assertStatus(200);
    }

     /**
     * Create new product with valid image (png)
     *
     * @return void
     */
    public function testCreateNewProductWithPNGImage()
    {
        Storage::fake('uploads');

        $file = UploadedFile::fake()->image('product.png');

        $data = [
            'name' => 'test name',
            'price' => 100,
            'description' => 'test description',
            'picture' => $file
        ];

        $response = $this->json('POST', '/api/add', $data);
        $response->assertStatus(200);
    }
    
}
