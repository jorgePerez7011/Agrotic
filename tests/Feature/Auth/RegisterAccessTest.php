<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_access_register_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Register');
    }
}
