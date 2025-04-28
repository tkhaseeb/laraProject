<html>
    <body>

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
        <input type="date" id="dob" name="dob" value="{{$student->date_of_birth}}"><br><br>

        <input type="submit" value="Submit">
    </form>
    </body>
</html>