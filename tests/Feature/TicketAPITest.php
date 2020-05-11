<?php

namespace Tests\Feature;

use App\Status;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class TicketAPITest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ticket_upload_from_a_user()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');
        $file = new UploadedFile('storage/app/public/photos/11585571153.jpeg', '1234', 'image/png', null, true);
        try {
            $response = $this->post('api/ticket/create', ['description' => 'يوجد حفرة عميقة في المكان هذا', 'latitude' => 90, 'longitude' => 90, 'city' => 6, 'neighborhood' => 3377, 'photos'=>[$file]]);
            $response->assertStatus(200);
        } catch (ValidationException $e) {
              echo $e->validator->errors();
        }
    }
}
