<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * Test a user with right details can login successful
     *
     * @return void
     */
    public function test_login_can_success()
    {
        $existingUser = User::factory()->create();
        // default password is password
        $data = ['email'=> $existingUser->email, 'password'=>'password'];

        $url = route('login');

        $response  = $this->Json('POST', $url, $data);
       

        // There was a successful response
        $response->assertStatus(200);
    }

    /**
     * Test a user with wrong details can bounce off
     *
     * @return void
     */
    public function test_login_can_fail()
    {

        $data = ['email'=> 'testemail@test.ng', 'password'=>'passme'];

        $url = route('login');

        $response  = $this->Json('POST', $url, $data);

        // There was a successful response
        $response->assertStatus(422);
    }
}
