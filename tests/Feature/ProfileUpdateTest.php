<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileUpdateTest extends TestCase
{
    /**
     * Test a user can update  profile
     *
     * @return void
     */
    public function test_user_can_update_profile()
    {
        $dept = Department::factory()->create();
        $designation = Designation::factory()->create(['department_id'=> $dept->id]);
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['*']);

        $data  = ['department_id'=>$dept->id, 'designation_id'=>$designation->id, 'emp_date'=>now()->toDateString()];

        $url = route('user.profile-update');

        $response = $this->Json('PUT', $url, $data);
      
        $response->assertStatus(201);
    }

    
    /**
     * Method test_user_cannot_update_profile_without_designation
     *
     * @return void
     */
    public function test_user_cannot_update_profile_without_designation()
    {
        $dept = Department::factory()->create();
        
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['*']);

        $data  = ['department_id'=>$dept->id, 'designation_id'=>23, 'emp_date'=>now()->toDateString()];

        $url = route('user.profile-update');

        $response = $this->Json('PUT', $url, $data);
      
        $response->assertStatus(422);
    }
}
