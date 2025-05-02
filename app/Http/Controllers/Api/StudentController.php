<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        try{
        $students = Student::where(function($query){
            if(request('name')){
                $query->where('name', 'LIKE', request('name')."%");
            }
            if(request('email')){
                $query->where('email', request('email'));
            }
        })->get();

        if($students->isEmpty()){
            return response()->json([
                'status' => false,
                'message' => 'No students found'
            ], 404);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'Students found',
                'students' => $students
            ], 200);
        }
    }
        catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Error: '.$e->getMessage()
            ], 500);
        }
        //return response()->json($students);
    }


    public function store(Request $request)
    {



        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        try {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $photo = $file->move(public_path('photos'), $filename);
                $request->merge(['photo' => $photo]);
            }

            DB::transaction(function () use ($request) {
                $student = Student::create($request->all());

                // $student->profile()->create([
                //     'student_id' => $student->id,
                //     'photo' => $request->photo,
                // ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Student created successfully',
                    'student' => $student
                ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
