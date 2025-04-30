@extends('layouts.app')
@section('content')
    <h1>Create Student</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h1>Student Registration</h1>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{old('name')}}"><br><br>

        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="{{old('email')}}"><br><br>

        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" value="{{old('phone')}}"><br><br>

        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address"  value="{{old('address')}}"><br><br>

        <label for="dob">Date of Birth:</label><br>
        <input type="date" id="date_of_birth" name="date_of_birth"><br><br>

        <label for="gender">Gender:</label><br>
        <select name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br><br>

        <label for="image">Student Photo:</label><br>
        <input type="file" name="photo" id="photo"><br><br>

        <input type="submit" value="Submit">
    </form>
    @endsection
