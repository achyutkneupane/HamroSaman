<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BidTest extends TestCase
{
    /**
     * A feature test to check if user can bid on a product without logging in.
     *
     * @return void
     */
    public function testCannotBidOnProductWithoutLoggingIn()
    {
        $this->seed();
        $user1 = User::factory()->create();
        $category = Category::orderBy('id', 'desc')->first();
        $product = Product::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category->id,
        ]);
        $product->auction()->create([
            'start_at' => now()->subMinutes(5),
            'end_at' => now()->addMinutes(5),
        ]);
        $response = $this->post('/products/buy/', [
            'product_id' => $product->id,
            'amount' => $product->min_price+100,
        ]);
        $response->assertRedirect('/login');
    }

    /**
     * A feature test to check if user can bid on a product after logging in.
     *
     * @return void
     */
    public function testCanBidOnProductAfterLoggingIn()
    {
        $this->seed();
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $category = Category::orderBy('id', 'desc')->first();
        $product = Product::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category->id,
        ]);
        $product->auction()->create([
            'start_at' => now()->subMinutes(5),
            'end_at' => now()->addMinutes(5),
        ]);
        auth()->attempt([
            'email' => $user2->email,
            'password' => 'password',
        ]);
        $response = $this->actingAs(auth()->user())->post('/products/buy/', [
            'product_id' => $product->id,
            'amount' => $product->min_price+100,
        ]);
        $response->assertSessionDoesntHaveErrors();
    }
}
