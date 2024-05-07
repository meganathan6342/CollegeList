<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $college->college_name }} Students</title>
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
        <h1>Students of {{ $college->college_name }} </h1>
        <input type="text" id="search" onkeyup="searchData()" placeholder="Search" style="margin-left: 940px;">
        <button id="add-btn" class="submit" style="color: white;" onclick="addPopup()">add student</button><br><br>
        <table id="dataTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="width: 150px;" onclick="shuffle(1)">Student Name</th>
                    <th style="width: 100px;">Student ID</th>
                    <th style="width: 80px;">Student Gender</th>
                    <th style="width: 80px;">Student DOB</th>
                    <th style="width: 150px;">Student Mobile no.</th>
                    <th style="width: 200px;">Student Address</th>
                    <th style="width: 150px;">College Name</th>
                    <th style="width: 100px;">Student Dept Name</th>
                    <th style="width: 80px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $a = 1; ?>
                @forelse($students as $student)
                <tr>
                    <td><?php echo $a++; ?></td>
                    <td style="width: 150px;">{{ $student->student_name }}</td>
                    <td style="width: 100px;">{{ $student->student_id }}</td>
                    <td style="width: 80px;">{{ $student->student_gender }}</td>
                    <td style="width: 80px;">{{ \Carbon\Carbon::parse($student->student_dob)->age }}</td>
                    <td style="width: 150px;">{{ $student->mobile_no }}</td>
                    <td style="max-width: 200px;">
                        {{ $student->addresses->address_id }},
                        {{ $student->addresses->street_1 }},
                        {{ $student->addresses->street_2 }},
                        {{ $student->addresses->city }},
                        {{ $student->addresses->state }},
                        {{ $student->addresses->country }}
                    </td>
                    <td style="width: 150px;">{{ $student->colleges->college_name }}</td>
                    <td style="width: 100px;">{{ $student->departments->dept_name }}</td>
                    <td style="width: 80px;">
                        <span title="edit" style="color: green;margin-left: 30px;" id="edit" onclick="editForm('<?php echo $student->student_id ?>'); addUpdatePopup();"><i class="fa-solid fa-pen-to-square"></i></span>
                        <span title="delete" style="color: red;margin-left: 10px;" id="delete" onclick="deleteStudent('<?php echo $student->student_id ?>')"><i class="fa-solid fa-trash"></i></span>
                    </td>
                </tr>
                @empty
                <tr style="background-color: white;">
                    <td colspan="5" style="border-style: none; color: red;">No students are here..</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div id="warnings" style="margin-left: 10px;">
            @if(session()->has('message'))
            <span style="color: green;" class="warning">{{ session()->get('message') }}</span>
            @endif
            <p style="color: red;" class="warning"></p>
        </div>
    </div>
    <div id="backDrop"></div>
    <div id="updateForm" class="forms"></div>
    <div id="addForm" class="forms">
        <button onclick="closePopup()" class="close-btn">X</i></button>
        <form action="{{ route('submit.student') }}" method="POST">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <td><input type="tel" name="college_id" value="{{ $college->college_id }}" style="visibility: hidden;"></td>
                    </tr>
                    <tr>
                        <td>Student Name : </td>
                        <td><input type="text" id="inp11" class="inp" name="student_name" required></td>
                    </tr>
                    <tr>
                        <td id="msg11">alphabets only allowed</td>
                    </tr>
                    <tr>
                        <td>Student Gender : </td>
                        <td><input type="radio" name="student_gender" value="M" required> : Male <input type="radio" name="student_gender" value="F"> : Female <input type="radio" name="student_gender" value="O"> : Others</td>
                    </tr>
                    <tr>
                        <td>Student DOB : </td>
                        <td><input type="date" id="dob1" class="inp" name="student_dob" required></td>
                    </tr>
                    <tr>
                        <td id="dob-msg1">select valid age</td>
                    </tr>
                    <tr>
                        <td>Student Mobile no. : </td>
                        <td><input type="tel" id="mobile-no1" class="inp" name="mobile_no" required></td>
                    </tr>
                    <tr>
                        <td id="mob-msg1">please enter valid mobile number</td>
                    </tr>
                    <tr>
                        <td>Street 1 : </td>
                        <td><input type="text" id="inp12" class="inp" name="street_1" required></td>
                    </tr>
                    <tr>
                        <td id="msg12">special char not allowed</td>
                    </tr>
                    <tr>
                        <td>Street 2 : </td>
                        <td><input type="text" id="inp13" class="inp" name="street_2" required></td>
                    </tr>
                    <tr>
                        <td id="msg13">special char not allowed</td>
                    </tr>
                    <tr>
                        <td>City : </td>
                        <td><input type="text" id="inp14" class="inp" name="city" required></td>
                    </tr>
                    <tr>
                        <td id="msg14">alphabets only allowed</td>
                    </tr>
                    <tr>
                        <td>State : </td>
                        <td><input type="text" id="inp15" class="inp" name="state" required></td>
                    </tr>
                    <tr>
                        <td id="msg15">alphabets only allowed</td>
                    </tr>
                    <tr>
                        <td>Country : </td>
                        <td><input type="text" id="inp16" class="inp" name="country" required></td>
                    </tr>
                    <tr>
                        <td id="msg16">alphabets only allowed</td>
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
                        <td colspan="2" style="text-align: right; padding-right: 50px;"><input type="submit" value="Submit" class="submit"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/52bd1c8b9d.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        function deleteStudent(id) {
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('delete.student') }}?data=" + encodedata;
        }

        function editForm(id) {
            $(document).ready(function() {
                $.ajax({
                    url: "{{route('student.form')}}",
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