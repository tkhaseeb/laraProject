<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\StudentStoreRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\SayHelloTrait;



class StudentController extends Controller
{
    use SayHelloTrait;

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
        })->with(['profile','payments','courses'])->paginate(25);
        //return $students;
        return $this->sayHello();
        return view('students.index', compact('students'));

    }

    public function create(){
        $courses = Course::all();
        return view('students.create',compact('courses'));
    }

    public function store(StudentStoreRequest $request){

try{
        
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $photo = $file->move(public_path('photos'), $filename);
            $request->merge(['photo' => $photo]);

        }
        \DB::transaction(function() use ($request) {
       
            $student = Student::create($request->except(['city', 'state', 'country', 'postal_code','course_id'])); //
            //$request->only(['name', 'email', 'phone', 'address', 'date_of_birth']);

            //return $student;
            $student->profile()->create([
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'postal_code' => $request->postal_code         
            ]);


            $student->courses()->attach($request->course_id);
        });


        return redirect('/students')->with('success', 'Student created successfully.');
    }catch(\Exception $e){
        return redirect('/students')->with('error', 'Something went wrong. Please try again.'.$e->getMessage()); 
    }
    }


    public function edit($id){
        $student = Student::find($id);
        $courses = Course::all();
        $studentCourses = $student->courses->pluck('id')->toArray();
        //return $studentCourses;
        //return $student;
        return view('students.edit', compact('student', 'courses', 'studentCourses'));
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

        $student->courses()->sync($request->course_id);

        //return redirect('/students')->with('success', 'Student updated successfully.');
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

    public function download(){
        $students = Student::paginate(25);
        //return $students;
        $pdf = Pdf::loadView('students.index', compact('students'));
        return $pdf->download('students.pdf');

        

  
    }
}
