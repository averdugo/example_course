<?php

namespace Tests\Feature;

use App\Models\Attendance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\StudentSeeder;
use Illuminate\Testing\Fluent\AssertableJson;

class StudentManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_student_seeder()
    {
        $this->seed(StudentSeeder::class);
        $this->assertDatabaseCount('students', 30);
    }

    public function test_student_list_can_be_retrieved(){
        $response = $this->get('/');
 
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('students'));    
    }

    public function test_attendance_can_be_created(){
        
        $response = $this->post('/attendance', [
            'student_id' => 88283823823,
            'status'     => true
        ]);

        $response->assertOk();        
        $this->assertCount(1, Attendance::all());

    }

    public function test_attendace_fails_with_no_studentId(){
        $response = $this->post('/attendance', [
            'student_id' => null,
            'status'     => true
        ]);

        $response->assertStatus(500);        
    }

    
}
