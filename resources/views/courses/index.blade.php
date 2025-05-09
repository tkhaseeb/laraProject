@extends('layouts.app')
@section('content')
    <h1>Course List</h1>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

<form method="GET" action="{{ route('courses.index') }}">
    <input type="text" name="name" placeholder="Search by name" value="{{ request('name') }}">
    <input type="text" name="email" placeholder="Search by email" value="{{ request('email') }}">
    <button type="submit">Search</button>
</form>

    <table border="1" class="table table-bordered table-striped">
        <tr>
            <th>Name</th>
            
            <th>Students</th>
            <th>Actions</th>
        </tr>
        @foreach ($courses as $course)
            <tr>
                <td>{{ $course->name }}</td>
                
                <td>
                @foreach($course->students as $student)
                    {{ $student->name }}

                @endforeach
                </td>
                <td>
                <a href="{{ route('courses.show', $course->id) }}">View</a> 
                <a href="{{ route('courses.edit', $course->id) }}">Edit</a>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    
            </tr>
        @endforeach
    </table>  
    
       
        
    <a href="{{ route('courses.create') }}">Add New Course</a>
    
@endsection
