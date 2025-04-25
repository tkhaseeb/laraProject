<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $students = Student::get();
        //return $students;
        return view('students.index', compact('students'));

    }

    public function create(){
        return view('students.create');
    }

    public function store(Request $request){

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->save();

        return redirect('/students')->with('success', 'Student created successfully.');
    }
}
