<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UserAPITest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_update()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create(['role_id' => 3]);
        $this->actingAs($user, 'api');
        try {
            $response = $this->post('api/user/update', ['name' => 'Ahmed', 'phone' => '0568748579', 'city' => 6, 'neighborhood' => '3430', 'gender' => 'MALE']);
            $response->assertStatus(200);
        } catch (ValidationException $e) {
            echo $e->validator->errors();
        }
    }
}
