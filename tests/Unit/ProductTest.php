<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public $readyData = [
        'name' => 'test name',
        'price' => 100,
        'description' => 'test description',
        'picture' => 'test'
    ];
    
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
        $data = $this->readyData;

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

        $data = $this->readyData;
        $data['picture'] = $file;
        $data['description'] = ' ';

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

        $data = $this->readyData;
        $data['picture'] = $file;
        $data['name'] = ' ';


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

        $data = $this->readyData;
        $data['picture'] = $file;

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

        $data = $this->readyData;
        $data['picture'] = $file;

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

        $data = $this->readyData;
        $data['picture'] = $file;

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

        $data = $this->readyData;
        $data['picture'] = $file;

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

        $data = $this->readyData;
        $data['picture'] = $file;

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

        $data = $this->readyData;
        $data['picture'] = $file;

        $response = $this->json('POST', '/api/add', $data);
        $response->assertStatus(200);
    }

    /**
     * Create product for testing edit functions
     *
     * @return int
     */
    public function createProductForEditTesting()
    {
        Storage::fake('uploads');

        $file = UploadedFile::fake()->image('product.jpg');

        $data = $this->readyData;
        $data['picture'] = $file;

        $response = $this->json('POST', '/api/add', $data);

        
        return $response->json()['id'];
    }

    /**
     * Create 25 products for testing pagination
     *
     * @return int
     */
    public function createProductForPaginationTesting()
    {
        Storage::fake('uploads');
        $file = UploadedFile::fake()->image('product.jpg');
        
        for ($i = 0; $i < 25; $i++) {        
            $data = $this->readyData;
            $data['name'] = $this->faker->name;
            $data['price'] = $this->faker->randomNumber(3);
            $data['picture'] = $file;
            $response = $this->json('POST', '/api/add', $data);
        }        

        return $response->json()['id'];
    }

    /**
     * Edit product without a name
     *
     * @return void
     */
    public function testEditProductWithoutName()
    {
        $id = $this->createProductForEditTesting();        
        $file = UploadedFile::fake()->image('product.jpg');

        $data = $this->readyData;
        $data['name'] = ' ';
        $data['picture'] = $file;

        $response = $this->json('PUT', "/api/update/{$id}", $data);
        $response->assertStatus(422);
        $response->assertJsonStructure(
            [
                'message',
                'errors' => [
                    'name'
                ]
            ]
        );
    }

    /**
     * Edit product without a description
     *
     * @return void
     */
    public function testEditProductWithoutDescription()
    {
        $id = $this->createProductForEditTesting();        
        $file = UploadedFile::fake()->image('product.jpg');

        $data = $this->readyData;
        $data['description'] = ' ';
        $data['picture'] = $file;

        $response = $this->json('PUT', "/api/update/{$id}", $data);
        $response->assertStatus(422);
        $response->assertJsonStructure(
            [
                'message',
                'errors' => [
                    'description'
                ]
            ]
        );
    }

    /**
     * Edit product without a price
     *
     * @return void
     */
    public function testEditProductWithoutPrice()
    {
        $id = $this->createProductForEditTesting();        
        $file = UploadedFile::fake()->image('product.jpg');

        $data = $this->readyData;
        unset($data['price']);
        $data['picture'] = $file;

        $response = $this->json('PUT', "/api/update/{$id}", $data);
        $response->assertStatus(422);
        $response->assertJsonStructure(
            [
                'message',
                'errors' => [
                    'price'
                ]
            ]
        );
    }

    /**
     * Edit product with an invalid image (bmp)
     *
     * @return void
     */
    public function testEditProductWithBMPImage()
    {
        $id = $this->createProductForEditTesting();        
        $file = UploadedFile::fake()->image('product.bmp');

        $data = $this->readyData;
        $data['picture'] = $file;

        $response = $this->json('PUT', "/api/update/{$id}", $data);
        $response->assertStatus(422);
        $response->assertJsonStructure(
            [
                'message',
                'errors' => [
                    'picture'
                ]
            ]
        );
    }

    /**
     * Test delete product with an invalid id
     *
     * @return void
     */
    public function testDeleteProductWithInvalidId()
    {
        $id = 99999;
        $response = $this->delete("/api/delete/{$id}");
        $response->assertStatus(404);
    }

    /**
     * Test delete product with a valid id
     *
     * @return void
     */
    public function testDeleteProductWithValidId()
    {
        $id = $this->createProductForEditTesting();

        $response = $this->delete("/api/delete/{$id}");
        $response->assertStatus(200);
        $response->assertJson(
            [
                "message" => "Product {$id} has been deleted."
            ]
        );
    }

    /**
     * Test pagination with default sorting (sort by ID ascending)
     *
     * @return void
     */
    public function testDefaultPagination()
    {
        $this->createProductForPaginationTesting();

        $response = $this->get("/products");
        $response->assertStatus(200);        
        $this->assertTrue(10 <= $response->json()['data']);
        $this->assertEquals(10, $response->json()['per_page']);
        $this->assertTrue(
            $response->json()['data'][0]['id'] < 
            $response->json()['data'][1]['id']
        );

        $this->assertTrue(
            $response->json()['data'][1]['id'] < 
            $response->json()['data'][2]['id']
        );
    }

    /**
     * Test pagination with sorting (product name ascending)
     *
     * @return void
     */
    public function testPaginationAscendingProductName()
    {
        $this->createProductForPaginationTesting();

        $response = $this->get("/products/?sort_by=name&order=asc");
        $response->assertStatus(200);
        
        $this->assertTrue(
            $response->json()['data'][0]['name'] <= 
            $response->json()['data'][1]['name']
        );

        $this->assertTrue(
            $response->json()['data'][1]['name'] <= 
            $response->json()['data'][2]['name']
        );
    }

    /**
     * Test pagination with sorting (product name descending)
     *
     * @return void
     */
    public function testPaginationDescendingProductName()
    {
        $this->createProductForPaginationTesting();

        $response = $this->get("/products/?sort_by=name&order=desc");
        $response->assertStatus(200);
        
        $this->assertTrue(
            $response->json()['data'][0]['name'] >= 
            $response->json()['data'][1]['name']
        );

        $this->assertTrue(
            $response->json()['data'][1]['name'] >= 
            $response->json()['data'][2]['name']
        );
    }

    /**
     * Test pagination with sorting (product price ascending)
     *
     * @return void
     */
    public function testPaginationAscendingProductPrice()
    {
        $this->createProductForPaginationTesting();

        $response = $this->get("/products/?sort_by=price&order=asc");
        $response->assertStatus(200);
        
        $this->assertTrue(
            $response->json()['data'][0]['price'] <= 
            $response->json()['data'][1]['price']
        );

        $this->assertTrue(
            $response->json()['data'][1]['price'] <= 
            $response->json()['data'][2]['price']
        );
    }

    /**
     * Test pagination with sorting (product price descending)
     *
     * @return void
     */
    public function testPaginationDescendingProductPrice()
    {
        $this->createProductForPaginationTesting();

        $response = $this->get("/products/?sort_by=price&order=desc");
        $response->assertStatus(200);
        
        $this->assertTrue(
            $response->json()['data'][0]['price'] >= 
            $response->json()['data'][1]['price']
        );

        $this->assertTrue(
            $response->json()['data'][1]['price'] >= 
            $response->json()['data'][2]['price']
        );
    }
}
