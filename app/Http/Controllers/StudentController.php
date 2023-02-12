<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Student, Attendance};
use Inertia\Inertia;

class StudentController extends Controller
{
    public function view() {
        $headers = Student::getTableHeaders();
        return Inertia::render('Students', compact( 'headers'));
    }

    public function getAttendance($date){
        $attendance =  Attendance::select('student_id')->where('created_at', $date)->get();     
        $temp = [];
        foreach ($attendance as &$valor) {
            array_push($temp, $valor->student_id);
        }
        return $temp;
    }

    
    public function index(Request $request)
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
                'students' => 'required',
                'date' => ''
            ]);    
    
            foreach ($data['students'] as &$valor) {            
                Attendance::create([
                    'student_id'    => $valor,
                    'status'        => true,
                    'created_at'    => $data['date']
                ]);                
            }                      
            
            return response()->json([
                'message' => 'Register ok'
            ], 200);
            
        }catch (\Exception $exception) {
            return response()->json([
                'message' => $exception
            ], 500);
        }
    }
}
