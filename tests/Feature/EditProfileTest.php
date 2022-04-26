<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EditProfileTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A feature test to check if user can access edit profile page without logging in.
     *
     * @return void
     */
    public function testCannotAccessEditProfileWithoutLoggedIn()
    {
        $user = User::factory()->create();
        $response = $this->get('/profile/edit');
        $response->assertRedirect('/login');
    }

    /**
     * A feature test to check if user can access edit profile page after logging in.
     *
     * @return void
     */
    public function testCanAccessEditProfileAfterLoggingIn()
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
        $response = $this->actingAs($authUser)->get('/profile/edit');
        $response->assertstatus(200);
    }

    /**
     * A feature test to check if user can edit their profile without any value
     *
     * @return void
     */
    public function testCannotEditProfileWithoutAnyValue()
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
        $response = $this->actingAs($authUser)->post('/profile/edit', []);
        $response->assertSessionHasErrors();
    }

    /**
     * A feature test to check if user can edit their profile with values passed
     *
     * @return void
     */
    public function testCanEditProfileOnlyWithValues()
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
        $response = $this->actingAs($authUser)->post('/profile/edit', [
            'full_name' => 'John Doe',
            'address' => $authUser->address,
            'phone' => $authUser->phone,
            'father_name' => $authUser->father_name,
            'mother_name' => $authUser->mother_name,
            'dob' => $authUser->dob,
            'profile_picture' => $authUser->profile_picture,
        ]);
        $response->assertSessionDoesntHaveErrors();
    }
}
