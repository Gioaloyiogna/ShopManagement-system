<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthenticatedUserCanAccessProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function test_authenticated_user_can_access_product(){
        $user=User::factory()->create();
        Sanctum::actingAs($user);
        $response=$this->get('/products');
        $response->assertStatus(200);
    }
}
