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
                            <td>
                                <select name="dept_short_code">
                                    <option value="{{$student->dept_short_code}}" style="background-color: rgb(200, 200, 200); border: 1px solid green;">{{ $student->departments->dept_name }}</option>
                                    @foreach($departments as $department)
                                    <option value="{{$department->dept_short_code}}">{{ $department->dept_name }}</option>
                                    @endforeach
                                </select>
                            </td>
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
                            <td><input type="tel" name="college_id" value="{{ $college->college_id }}" style="visibility: hidden;"></td>
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
                            <td>
                                <select name="dept_short_code" id="dsc" required>
                                    @foreach($departments as $department)
                                    <option value="{{$department->dept_short_code}}">{{ $department->dept_name }}</option>
                                    @endforeach
                                </select>
                            </td>
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
    </div>
    <script>
        let dsc = document.getElementById("dsc").value;
        console.log(dsc);
    </script>
</body>

</html>