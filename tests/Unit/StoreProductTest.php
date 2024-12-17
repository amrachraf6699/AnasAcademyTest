<?php

namespace Tests\Unit;

use App\Models\{Product, User, Category};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Test if a seller user can create a product.
     */
    public function test_seller_can_create_product(): void
    {
        $user = User::factory()->seller()->create();

        $category = Category::create(['name' => 'Test Category']);
        

        $response = $this->actingAs($user)->post(route('myproducts.store'), [
            'name' => 'Product 1',
            'price' => 100,
            'quantity' => 10,
            'category_id' => $category->id,
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Product 1',
            'price' => 100,
            'quantity' => 10,
            'category_id' => $category->id,
        ]);

        $response->assertRedirect(route('myproducts.index'));
    }
}
