<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}" />
</head>

<body>
    <div id="mydiv">
        <div id="form">
            @if(isset($student))
            <form action="{{ route('editing.student', $student->student_id)}}" method="POST">
                @csrf
                @method('PUT')
                <table>
                    <tbody>
                        <tr>
                            <td><input type="tel" name="college_id" value="{{ $student->college_id }}" style="visibility: hidden;" required></td>
                        </tr>
                        <tr>
                            <td>Student Name : </td>
                            <td><input type="text" name="student_name" value="{{ $student->student_name }}" required></td>
                        </tr>
                        <tr>
                            <td>Student Gender : </td>
                            <td><input type="radio" name="student_gender" value="M" required {{ $student->student_gender == 'M' ? 'checked' : '' }}> : Male <input type="radio" name="student_gender" value="F" {{ $student->student_gender == 'F' ? 'checked' : '' }}> : Female <input type="radio" name="student_gender" value="O" {{ $student->student_gender == 'O' ? 'checked' : '' }}> : Others</td>
                        </tr>
                        <tr>
                            <td>Student DOB : </td>
                            <td><input type="date" name="student_dob" value="{{ $student->student_dob }}" required></td>
                        </tr>
                        <tr>
                            <td>Student Mobile no. : </td>
                            <td><input type="tel" name="mobile_no" value="{{ $student->mobile_no }}" required></td>
                        </tr>
                        <input type="tel" name="address_id" value="{{ $student->addresses->address_id }}" style="visibility: hidden;" required>
                        <tr>
                            <td>Street 1 : </td>
                            <td><input type="text" name="street_1" value="{{ $student->addresses->street_1 }}" required></td>
                        </tr>
                        <tr>
                            <td>Street 2 : </td>
                            <td><input type="text" name="street_2" value="{{ $student->addresses->street_2 }}" required></td>
                        </tr>
                        <tr>
                            <td>City : </td>
                            <td><input type="text" name="city" value="{{ $student->addresses->city }}" required></td>
                        </tr>
                        <tr>
                            <td>State : </td>
                            <td><input type="text" name="state" value="{{ $student->addresses->state }}" required></td>
                        </tr>
                        <tr>
                            <td>Country : </td>
                            <td><input type="text" name="country" value="{{ $student->addresses->country }}" required></td>
                        </tr>
                        <tr>
                            <td>College Id : </td>
                            <td><input type="tel" name="college_id" value="{{ $student->college_id }}" required></td>
                        </tr>
                        <tr>
                            <td>Student dept short code : </td>
                            <td><input type="text" name="dept_short_code" value="{{ $student->dept_short_code }}" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right; padding-right: 100px;"><input type="submit" value="Update" class="submit"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
            @else
            <form action="submit-student" method="POST">
                @csrf
                <table>
                    <tbody>
                        <tr>
                            <td><input type="tel" name="college_id" value="{{ $id }}" style="visibility: hidden;"></td>
                        </tr>
                        <tr>
                            <td>Student Name : </td>
                            <td><input type="text" name="student_name" required></td>
                        </tr>
                        <tr>
                            <td>Student Gender : </td>
                            <td><input type="radio" name="student_gender" value="M" required> : Male <input type="radio" name="student_gender" value="F"> : Female <input type="radio" name="student_gender" value="O"> : Others</td>
                        </tr>
                        <tr>
                            <td>Student DOB : </td>
                            <td><input type="date" name="student_dob" required></td>
                        </tr>
                        <tr>
                            <td>Student Mobile no. : </td>
                            <td><input type="tel" name="mobile_no" required></td>
                        </tr>
                        <tr>
                            <td>Street 1 : </td>
                            <td><input type="text" name="street_1" required></td>
                        </tr>
                        <tr>
                            <td>Street 2 : </td>
                            <td><input type="text" name="street_2" required></td>
                        </tr>
                        <tr>
                            <td>City : </td>
                            <td><input type="text" name="city" required></td>
                        </tr>
                        <tr>
                            <td>State : </td>
                            <td><input type="text" name="state" required></td>
                        </tr>
                        <tr>
                            <td>Country : </td>
                            <td><input type="text" name="country" required></td>
                        </tr>
                        <tr>
                            <td>Student dept short code : </td>
                            <td><input type="text" name="dept_short_code" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right; padding-right: 100px;"><input type="submit" value="Submit" class="submit"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
            @endif
            @if(session()->has('message'))
            <p style="color: red;">{{ session()->get('message') }}</p>
            @endif
        </div>
        <div id="depts">
            <div id="depts">
                <h3>Our Departments</h3>
                @if(isset($departments))
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Dept Name</th>
                            <th>Dept Short Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $b = 1 ?>
                        @foreach($departments as $department)
                        <tr>
                            <td><?php echo $b++ . '.'; ?></td>
                            <td>{{ $department->dept_name }}</td>
                            <td>{{ $department->dept_short_code }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <span>please first add a department</span>
                @endif
            </div>
        </div>
    </div>
</body>

</html>