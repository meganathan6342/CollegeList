<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Form</title>
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}" />
</head>

<body>
    <div id="mydiv">
        <div id="form">
            @if(isset($staff))
            <form action="{{ route('editing.staff', $staff->staff_id)}}" method="POST">
                @csrf
                @method('PUT')
                <table>
                    <tbody>
                        <tr>
                            <td><input type="tel" name="college_id" value="{{ $staff->college_id }}" style="visibility: hidden;" class="inp"></td>
                        </tr>
                        <tr>
                            <td>Staff Name : </td>
                            <td><input type="text" name="staff_name" value="{{ $staff->staff_name }}" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>Staff Gender : </td>
                            <td><input type="radio" name="staff_gender" value="M" required {{ $staff->staff_gender == 'M' ? 'checked' : '' }}> : Male <input type="radio" name="staff_gender" value="F" {{ $staff->staff_gender == 'F' ? 'checked' : '' }}> : Female <input type="radio" name="staff_gender" value="O" {{ $staff->staff_gender == 'O' ? 'checked' : '' }}> : Others</td>
                        </tr>
                        <tr>
                            <td>Staff DOB : </td>
                            <td><input type="date" name="staff_dob" value="{{ $staff->staff_dob }}" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>Staff Mobile no. : </td>
                            <td><input type="tel" name="mobile_no" value="{{ $staff->mobile_no }}" class="inp" required></td>
                        </tr>
                        <input type="tel" name="address_id" value="{{ $staff->addresses->address_id }}" style="visibility: hidden;" class="inp" required>
                        <tr>
                            <td>Street 1 : </td>
                            <td><input type="text" name="street_1" value="{{ $staff->addresses->street_1 }}" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>Street 2 : </td>
                            <td><input type="text" name="street_2" value="{{ $staff->addresses->street_2 }}" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>City : </td>
                            <td><input type="text" name="city" value="{{ $staff->addresses->city }}" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>State : </td>
                            <td><input type="text" name="state" value="{{ $staff->addresses->state }}" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>Country : </td>
                            <td><input type="text" name="country" value="{{ $staff->addresses->country }}" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>College Id : </td>
                            <td><input type="tel" name="college_id" value="{{ $staff->college_id }}" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>Staff dept short code : </td>
                            <td><input type="text" name="dept_short_code" value="{{ $staff->dept_short_code }}" class="inp" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right; padding-right: 100px;"><input type="submit" value="Update" class="submit"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
            @else
            <form action="submit-staff" method="POST">
                @csrf
                <table>
                    <tbody>
                        <tr>
                            <td><input type="tel" name="college_id" value="{{ $id }}" style="visibility: hidden;" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>Staff Name : </td>
                            <td><input type="text" name="staff_name" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>Staff Gender : </td>
                            <td><input type="radio" name="staff_gender" value="M" required> : Male <input type="radio" name="staff_gender" value="F"> : Female <input type="radio" name="staff_gender" value="O"> : Others</td>
                        </tr>
                        <tr>
                            <td>Staff DOB : </td>
                            <td><input type="date" name="staff_dob" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>Staff Mobile no. : </td>
                            <td><input type="tel" name="mobile_no" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>Street 1 : </td>
                            <td><input type="text" name="street_1" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>Street 2 : </td>
                            <td><input type="text" name="street_2" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>City : </td>
                            <td><input type="text" name="city" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>State : </td>
                            <td><input type="text" name="state" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>Country : </td>
                            <td><input type="text" name="country" class="inp" required></td>
                        </tr>
                        <tr>
                            <td>Staff dept short code : </td>
                            <td><input type="text" name="dept_short_code" class="inp" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right; padding-right: 100px;"><input type="submit" value="Submit" class="submit"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
            @endif
            @if(session()->has('message'))
            <p style="color: green;">{{ session()->get('message') }}</p>
            @endif
        </div>
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
                    <?php $b = 1?>
                    @foreach($departments as $department)
                    <tr>
                        <td><?php echo $b++.'.'; ?></td>
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
</body>

</html>