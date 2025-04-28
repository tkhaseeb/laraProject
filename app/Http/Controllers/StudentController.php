<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $students = Student::where(function($query){
            if(request('name')){
                //$name = request('name');
                $query->where('name', 'LIKE', request('name')."%")->get();
            }
            if(request('email')){
                //$name = request('name');
                $query->where('email', request('email'))->get();
            }
        })->paginate(5);
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
        $student->date_of_birth = $request->dob;
        $student->save();

        return redirect('/students')->with('success', 'Student created successfully.');
    }


    public function edit($id){
        $student = Student::find($id);
        //return $student;
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id){

        //return $id;
        $student = Student::find($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->date_of_birth = $request->dob;
        $student->save();

        return redirect('/students')->with('success', 'Student updated successfully.');
    }

    public function destroy($id){
        $student = Student::find($id);
        $student->delete();

        return redirect('/students')->with('success', 'Student deleted successfully.');
    }

    public function show($id){
        $student = Student::find($id);
        return view('students.show', compact('student'));
    }
}
