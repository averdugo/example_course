<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Student, Attendance};

class StudentController extends Controller
{
    
    public function index()
    {
        $students = Student::all();

        return response([
            'students' => $students
        ], 200);
    }

    public function attendance()
    {
        try {
            $data = request()->validate([
                'student_id' => 'required'
            ]);
            Attendance::create($data);
            
            return response()->json([
                'message' => 'Register ok'
            ], 200);
            
        }catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error try again!'
            ], 500);
        }        
    }
}
