@extends('layouts.app')
@section('content')
    <h1>Edit Student</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<h1>Edit Student</h1>
    <form action="{{ route('students.update',$student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h1>Student Registration</h1>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{$student->name}}"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="{{$student->email}}"><br><br>

        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" value="{{$student->phone}}"><br><br>

        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address" value="{{$student->address}}"><br><br>

        <label for="dob">Date of Birth:</label><br>
        <input type="date" id="date_of_birth" name="date_of_birth" value="{{$student->date_of_birth}}"><br><br>

        <label for="dob">Gender:</label><br>
        <select name="gender">
            <option value="male" @if($student->gender == 'male') selected @endif>Male</option>
            <option value="female" @if($student->gender == 'female') selected @endif>Female</option>
        </select><br><br>

        <label for="image">Student Photo:</label><br>
        <input type="file" name="photo" id="photo"><br><br>
        

        <input type="submit" value="Submit">
    </form>
@endsection