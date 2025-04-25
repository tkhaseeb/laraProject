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

    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>DOB</th>
        </tr>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ $student->address }}</td>
                <td>{{ $student->date_of_birth }}</td>
            </tr>
        @endforeach
    </table>  
    <a href="{{ route('students.create') }}">Add New Student</a>
</html>