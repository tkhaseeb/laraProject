<html>
<head>
    <title>Teacher List</title>
</head>
<body>
    <h1>Teacher List</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>DOB</th>
            <th>Subject</th>
            <th>Qualification</th>
            <th>Experience</th>
            <th>Salary</th>
        </tr>
        @foreach ($teachers as $teacher)
            <tr>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->email }}</td>
                <td>{{ $teacher->phone }}</td>
                <td>{{ $teacher->address }}</td>
                <td>{{ $teacher->date_of_birth }}</td>
                <td>{{ $teacher->subject }}</td>
                <td>{{ $teacher->qualification }}</td>
                <td>{{ $teacher->experience }}</td>
                <td>{{ $teacher->salary }}</td>

            </tr>
        @endforeach
    </table>  
</html>