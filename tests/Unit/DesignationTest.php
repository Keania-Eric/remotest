<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Department;
use App\Models\Designation;

class DesignationTest extends TestCase
{
    /**
     * Test we can retrieve all designation
     *
     * @return void
     */
    public function test_designation_can_be_retrieve()
    {
        $depts = Designation::factory()->create();

        $response = $this->Json('GET', route('designation.all'));

        $response->assertStatus(200);
    }


    public function test_designation_can_be_created()
    {
        $data = ['name'=> 'Test name', 'department_id'=> Department::factory()->create()->id];

        $url = route('department.create');

        $response = $this->Json('POST', $url, $data);

        $response->assertStatus(201);
    }
}
