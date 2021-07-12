<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Department;

class DepartmentTest extends TestCase
{
    /**
     * Test we can retrieve all departments
     *
     * @return void
     */
    public function test_department_can_be_retrieve()
    {
        $depts = Department::factory()->create();

        $response = $this->Json('GET', route('department.all'));

        $response->assertStatus(200);
    }


    public function test_department_can_be_created()
    {
        $data = ['name'=> 'Test name'];

        $url = route('department.create');

        $response = $this->Json('POST', $url, $data);

        $response->assertStatus(201);
    }
}
