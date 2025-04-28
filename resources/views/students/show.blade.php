<html>


<body>
    <h1>Student Details</h1>

    <p><strong>Name:</strong> {{ $student->name }}</p>
    <p><strong>Email:</strong> {{ $student->email }}</p>
    <p><strong>Phone:</strong> {{ $student->phone }}</p>
    <p><strong>Address:</strong> {{ $student->address }}</p>
    <p><strong>Date of Birth:</strong> {{ $student->date_of_birth }}</p>

    <a href="{{ route('students.index') }}">Back to Student List</a>

</html>