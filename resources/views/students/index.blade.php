<html>
<head>
    <title>Student List</title>
</head>
<body>
    <h1>Student List</h1>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

<form method="GET" action="{{ route('students.index') }}">
    <input type="text" name="name" placeholder="Search by name" value="{{ request('name') }}">
    <input type="text" name="email" placeholder="Search by email" value="{{ request('email') }}">
    <button type="submit">Search</button>
</form>

    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>DOB</th>
            <th>Actions</th>
        </tr>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ $student->address }}</td>
                <td>{{ $student->date_of_birth }}</td>
                <td>
                <a href="{{ route('students.show', $student->id) }}">View</a> 
                <a href="{{ route('students.edit', $student->id) }}">Edit</a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
            </tr>
        @endforeach
    </table>  
    
        {{ $students->links() }} <!-- Pagination links -->
        
    <a href="{{ route('students.create') }}">Add New Student</a>
</html>