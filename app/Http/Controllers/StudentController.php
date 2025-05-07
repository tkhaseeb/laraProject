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



        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        //$student = new Student();
        // $student->name = $request->name;
        // $student->email = $request->email;
        // $student->phone = $request->phone;
        // $student->address = $request->address;
        // $student->date_of_birth = $request->dob;
        // $student->save();
        
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $photo = $file->move(public_path('photos'), $filename);
            $request->merge(['photo' => $photo]);

        }

        $student = Student::create($request->except(['city', 'state', 'country', 'postal_code'])); //
         //$request->only(['name', 'email', 'phone', 'address', 'date_of_birth']);

        //return $student;
        $student->profile()->create([
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code         
        ]);

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


    public function makePayment($id){
        //return $id;
        $student = Student::find($id);
        return view('students.payments.create', compact('student'));
    }

    public function storePayment(Request $request, $id){
        //return $id;
        $student = Student::find($id);
        //return $student;
        $request->validate([
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string|max:255'
        ]);

        $student->payments()->create([
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method
        ]);

        return redirect('/students')->with('success', 'Payment made successfully.');
    }
}
