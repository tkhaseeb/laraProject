@extends('layouts.app')
@section('content')
    <h1>Welcome to the Student Management System</h1>
    <p>This is a simple application to manage student records.</p>
    <p><a href="{{ route('students.index') }}" class="btn btn-primary">View Students</a></p>
    <p><a href="{{ route('students.create') }}" class="btn btn-secondary">Add New Student</a></p>   

    @endsection