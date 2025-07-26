<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function authenticated_user_can_create_a_product()
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)->post('/products', [
            'name' => 'Test Product',
            'description' => 'A test product description',
            'quantity' => 5,
            'price' => 99.99,
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'created_by' => $user->id,
        ]);

    }
    /** @test */
    public function authenticated_user_can_delete_a_product()
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $product = Product::factory()->create([
            'created_by' => $user->id
        ]);

        $response = $this->actingAs($user)->delete("/products/{$product->id}");

        $response->assertRedirect('/products/my_products');
        $this->assertSoftDeleted('products', [
            'id' => $product->id,
        ]);
    }
}
