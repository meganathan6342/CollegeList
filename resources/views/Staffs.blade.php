<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $college->college_name }} Staff's</title>
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/form.css') }}" />
</head>

<body>
    <div id="mydiv" style="margin-left: 3px;">
        <h1>Staff's of {{ $college->college_name }} </h1>
        <input type="text" id="search" onkeyup="searchData()" placeholder="Search" style="margin-left: 940px;">
        <button id="add-btn" style="color: white;">add staff</button><br><br>
        <table id="dataTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="width: 150px;" onclick="shuffle(1)">Staff Name</th>
                    <th style="width: 100px;">Staff ID</th>
                    <th style="width: 80px;">Staff Gender</th>
                    <th style="width: 80px;">Staff DOB</th>
                    <th style="width: 150px;">Staff Mobile no.</th>
                    <th style="width: 200px;">Staff Address</th>
                    <th style="width: 150px;">College Name</th>
                    <th style="width: 100px;">Staff Dept Name</th>
                    <th style="width: 80px;">Action</th>
                </tr>
            <tbody>
                <?php $a = 1; ?>
                @forelse($staffs as $staff)
                <tr>
                    <td><?php echo $a++; ?></td>
                    <td style="width: 150px;">{{ $staff->staff_name }}</td>
                    <td style="width: 100px;">{{ $staff->staff_id }}</td>
                    <td style="width: 80px;">{{ $staff->staff_gender }}</td>
                    <td style="width: 80px;">{{ \Carbon\Carbon::parse($staff->staff_dob)->age }}</td>
                    <td style="width: 150px;">{{ $staff->mobile_no }}</td>
                    <td style="width: 200px;">{{ $staff->addresses->address_id }},
                        {{ $staff->addresses->street_1 }},
                        {{ $staff->addresses->street_2 }},
                        {{ $staff->addresses->city }},
                        {{ $staff->addresses->state }},
                        {{ $staff->addresses->country }}
                    </td>
                    <td style="width: 150px;">{{ $staff->colleges->college_name }}</td>
                    <td style="width: 100px;">{{ $staff->departments->dept_name }}</td>
                    <td style="width: 80px;">
                        <span title="edit" style="color: green;margin-left: 20px;" id="edit" onclick="editStaff('<?php echo $staff->staff_id ?>');"><i class="fa-solid fa-pen-to-square"></i></span>
                        <span title="delete" style="color: red;margin-left: 10px;" class="delete" onclick="deleteStaff('<?php echo $staff->staff_id ?>')"><i class="fa-solid fa-trash"></i></span>
                    </td>
                </tr>
                @empty
                <tr style="background-color: white;">
                    <td colspan="5" style="border-style: none; color: red;">No staffs are here..</td>
                </tr>
                @endforelse
            </tbody>
            </thead>
            <tbody></tbody>
        </table>
        <div id="warnings">
            @if(session()->has('message'))
            <span style="color: green;" class="warning">{{ session()->get('message') }}</span>
            @endif
            <p style="color: red;" class="warning"></p>
        </div>
    </div>
    <div id="backdrop" class="backdrop" style="display:none;"></div>
    <div id="form" style="display: none;">
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
                        <td><input type="text" name="staff_name" value="{{ $staff->staff_name }}" id="inp1" class="inp" required></td>
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
                        <td>Department Name : </td>
                        <td>
                            <select name="dept_short_code" value="{{ $staff->departments->dept_name }}" required>
                                @foreach($departments as $department)
                                <option value="{{ $department->dept_short_code }}">{{ $department->dept_name }}</option>
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
        <form action="{{ route('submit.staff') }}" method="POST">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <td><input type="tel" name="college_id" value="{{ $college->college_id }}" style="visibility: hidden;" class="inp" required></td>
                    </tr>
                    <tr>
                        <td>Staff Name : </td>
                        <td><input type="text" name="staff_name" id="inp1" class="inp" required></td>
                    </tr>
                    <tr>
                        <td style="color: red;" id="name">alphabets only allowed</td>
                    </tr>
                    <tr>
                        <td>Staff Gender : </td>
                        <td><input type="radio" name="staff_gender" value="M" required> : Male <input type="radio" name="staff_gender" value="F"> : Female <input type="radio" name="staff_gender" value="O"> : Others</td>
                    </tr>
                    <tr>
                        <td>Staff DOB : </td>
                        <td><input type="date" name="staff_dob" class="inp" id="inp3" onblur="calculateAge()"><span style="margin-left: 8px;"></span></td>
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
                        <td>Select Depatment : </td>
                        <td>
                            <select name="dept_short_code" required>
                                @foreach($departments as $department)
                                <option value="{{ $department->dept_short_code }}">{{ $department->dept_name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><button class="submit" onclick="closePopup()">Close</button></td>
                        <td style="text-align: right; padding-right: 50px;"><input type="submit" value="Submit" class="submit"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        @endif
        @if(session()->has('message'))
        <p style="color: green;">{{ session()->get('message') }}</p>
        @endif
    </div>
    <script src="https://kit.fontawesome.com/52bd1c8b9d.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/form.js') }}"></script>
    <script>
        function deleteStaff(id) {
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('delete.staffs') }}?data=" + encodedata;
        }

        function editStaff(id) {
            document.getElementById('form').style.display = 'block';
            document.getElementById('backdrop').style.display = 'block';
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('edit.staff') }}?data=" + encodedata;
        }
    </script>
</body>

</html>