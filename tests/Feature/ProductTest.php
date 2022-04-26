<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A feature test to check if user can access add product page without logging in.
     *
     * @return void
     */
    public function testCannotAccessAddProductWithoutLoggedIn()
    {
        $user = User::factory()->create();
        $response = $this->get('/dashboard/product/add');
        $response->assertRedirect('/login');
    }

    /**
     * A feature test to check if user can access add product page after logging in.
     *
     * @return void
     */
    public function testCanAccessAddProductAfterLoggingIn()
    {
        $user = User::factory()->create([
            'full_name' => 'John Doe',
            'email' => 'test@email.com',
            'password' => Hash::make('password'),
        ]);
        auth()->attempt([
            'email' => $user->email,
            'password' => 'password',
        ]);
        $authUser = Auth::user();
        $response = $this->actingAs($authUser)->get('/dashboard/product/add');
        $response->assertStatus(200);
    }

    /**
     * A feature test to check if user can access dashboard access to other's product.
     *
     * @return void
     */
    public function testUserCannotAccessOtherSellersProductDashboard()
    {
        $this->seed();
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $category = Category::orderBy('id', 'desc')->first();
        $product = Product::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category->id,
        ]);
        Auth::attempt([
            'email' => $user2->email,
            'password' => 'password',
        ]);
        $response = $this->actingAs(auth()->user())->get('/dashboard/products/'.$product->slug);
        $response->assertStatus(404);
    }
}
