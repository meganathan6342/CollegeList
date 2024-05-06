<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $college->college_name }} Staff's</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .close-btn {
            background-color: red;
            color: white;
            margin-left: 94%;
            border: 0px;
            border-radius: 4px;
        }

        .close-btn:hover {
            background-color: rgb(214, 9, 9);
        }

        #addForm {
            padding: 15px 25px;
        }

        #updateForm {
            padding: 15px 25px;
        }
    </style>
</head>

<body>
    <div id="mydiv" style="margin-left: 3px;">
        <h1>Staff's of {{ $college->college_name }} </h1>
        <input type="text" id="search" onkeyup="searchData()" placeholder="Search" style="margin-left: 940px;">
        <button id="add-btn" class="submit" style="color: white;" onclick="addPopup()">add staff</button><br><br>
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
            <tbody id="searchedData">
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
                        <span title="edit" style="color: green;margin-left: 30px;" id="edit" onclick="editForm('<?php echo $staff->staff_id ?>'); addUpdatePopup();"><i class="fa-solid fa-pen-to-square"></i></span>
                        <span title="delete" style="color: red;margin-left: 10px;" id="delete" onclick="deleteStaff('<?php echo $staff->staff_id ?>')"><i class="fa-solid fa-trash"></i></span>
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
    <div id="backDrop"></div>
    <div id="updateForm" class="forms"></div>
    <div id="addForm" class="forms">
        <button onclick="closePopup()" class="close-btn" style="margin-bottom: 20px;">X</i></button>
        <form action="{{ route('submit.staff') }}" method="POST">
            @csrf
            <table>
                <tbody>
                    <input type="tel" name="college_id" value="{{ $college->college_id }}" style="visibility: hidden;" class="inp" required>
                    <tr>
                        <td>Staff Name : </td>
                        <td><input type="text" name="staff_name" id="inp11" class="inp" required></td>
                    </tr>
                    <tr>
                        <td id="msg11">alphabets only allowed</td>
                    </tr>
                    <tr>
                        <td>Staff Gender : </td>
                        <td><input type="radio" name="staff_gender" value="M" required> : Male <input type="radio" name="staff_gender" value="F"> : Female <input type="radio" name="staff_gender" value="O"> : Others</td>
                    </tr>
                    <tr>
                        <td>Staff DOB : </td>
                        <td><input type="date" name="staff_dob" class="inp" id="dob1" onblur="calculateAge()"><span style="margin-left: 8px;"></span></td>
                    </tr>
                    <tr>
                        <td id="dob-msg1">select valid age</td>
                    </tr>
                    <tr>
                        <td>Staff Mobile no. : </td>
                        <td><input type="tel" name="mobile_no" id="mobile-no1" class="inp" required></td>
                    </tr>
                    <tr>
                        <td id="mob-msg1">please enter valid mobile number</td>
                    </tr>
                    <tr>
                        <td>Street 1 : </td>
                        <td><input type="text" name="street_1" id="inp12" class="inp" required></td>
                    </tr>
                    <tr>
                        <td id="msg12">special char not allowed</td>
                    </tr>
                    <tr>
                        <td>Street 2 : </td>
                        <td><input type="text" name="street_2" id="inp13" class="inp" required></td>
                    </tr>
                    <tr>
                        <td id="msg13">special char not allowed</td>
                    </tr>
                    <tr>
                        <td>City : </td>
                        <td><input type="text" name="city" id="inp14" class="inp" required></td>
                    </tr>
                    <tr>
                        <td id="msg14">alphabets only allowed</td>
                    </tr>
                    <tr>
                        <td>State : </td>
                        <td><input type="text" name="state" id="inp15" class="inp" required></td>
                    </tr>
                    <tr>
                        <td id="msg15">alphabets only allowed</td>
                    </tr>
                    <tr>
                        <td>Country : </td>
                        <td><input type="text" name="country" id="inp16" class="inp" required></td>
                    </tr>
                    <tr>
                        <td id="msg16">alphabets only allowed</td>
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
                        <td colspan="2" style="text-align: right; padding-right: 50px;"><input type="submit" value="Submit" class="submit"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/52bd1c8b9d.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        function deleteStaff(id) {
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('delete.staffs') }}?data=" + encodedata;
        }

        function editForm(id) {
            $(document).ready(function() {
                $.ajax({
                    url: "{{route('staff.form')}}",
                    type: 'GET',
                    data: {
                        data: id
                    },
                    success: function(response) {
                        $('#updateForm').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        }
    </script>
</body>

</html>