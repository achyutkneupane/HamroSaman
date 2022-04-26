<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A feature test to check if user can chat with product owners.
     *
     * @return void
     */
    public function testCanChatWithProductOwners()
    {
        $this->seed();
        $user1 = User::factory()->create();
        $category = Category::orderBy('id', 'desc')->first();
        $product = Product::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category->id,
        ]);
        $user2 = User::factory()->create();
        auth()->attempt([
            'email' => $user2->email,
            'password' => 'password',
        ]);
        $response = $this->actingAs(auth()->user())->post('/messages', [
            'product_id' => $product->id,
            'message' => 'This is a test message',
        ]);
        $response->assertSessionDoesntHaveErrors();
    }
}
