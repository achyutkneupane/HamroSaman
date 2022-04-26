<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A feature test to check if user can comment on product without logging in.
     *
     * @return void
     */
    public function testCanCommentOnProducts()
    {
        $this->seed();
        $user = User::factory()->create();
        $category = Category::orderBy('id', 'desc')->first();
        $product = Product::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);
        auth()->attempt([
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->actingAs(auth()->user())->post('/product/comment/', [
            'product_id' => $product->id,
            'content' => 'This is a comment',
        ]);
        $response->assertSessionDoesntHaveErrors();
    }
}
