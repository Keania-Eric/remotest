<?php

namespace Tests\Unite;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    /**
     * Test user can register successfully
     *
     * @return void
     */
    public function test_user_can_register_successfully()
    {
        
        $testData  = User::factory()->make()->toArray();

        //set password and password confirmation
        $testData['password'] = 'password';
        $testData['password_confirmation'] = 'password';

        $url = route('register');

        $response = $this->Json('POST', $url, $testData);
        
        // User created response
        $response->assertStatus(201);
    }

    
    /**
     * Method test_missing_register_params_throws_validation_error
     *
     * @return void
     */
    public function test_missing_register_params_throws_validation_error()
    {
        $testData  = User::factory()->make()->toArray();
        //skip a  value
        unset($testData['name']);

        $url = route('register');

        $response = $this->Json('POST', $url, $testData);

        // User created response
        $response->assertStatus(422);
    }
}
