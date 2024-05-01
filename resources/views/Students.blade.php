<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $college->college_name }} Students</title>
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}" />
    <style>
        a {
            text-decoration: none;
            color: white;
            font-size: 17px;
        }

        #add-btn {
            background-color: blue;
            height: 27px;
            width: 120px;
            border-radius: 5px;
            border-style: none;
            transition: 200ms;
        }

        #add-btn:hover {
            transform: scale(1.02);
            background-color: rgb(0, 0, 230);
        }

        #search {
            margin-left: 1010px;
            height: 23px;
        }
    </style>
</head>

<body>
    <div id="mydiv" style="margin-left: 3px;">
        <h1>Students of {{ $college->college_name }} </h1>
        <input type="text" id="search" onkeyup="searchData()" placeholder="Search">
        <button id="add-btn"><a href="{{ route('students.form', ['id'=>$college->college_id]) }}">add student</a></button><br><br>
        <table id="dataTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="width: 100px;">Student ID</th>
                    <th style="width: 150px;">Student Name</th>
                    <th style="width: 80px;">Student Gender</th>
                    <th style="width: 80px;">Student DOB</th>
                    <th style="width: 150px;">Student Mobile no.</th>
                    <th style="width: 200px;">Student Address</th>
                    <th style="width: 150px;">College Name</th>
                    <th style="width: 100px;">Student Dept Name</th>
                    <th style="width: 80px;">Action</th>
                </tr>
            <tbody>
                <?php $a = 1; ?>
                @foreach($students as $student)
                <tr>
                    <td><?php echo $a++; ?></td>
                    <td style="width: 100px;">{{ $student->student_id }}</td>
                    <td style="width: 150px;">{{ $student->student_name }}</td>
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
                        <span style="color: green;margin-left: 20px;" id="edit" onclick="editStudent('<?php echo $student->student_id ?>')"><i class="fa-solid fa-pen-to-square"></i></span>
                        <span style="color: red;margin-left: 10px;" id="delete" onclick="deleteStudent('<?php echo $student->student_id ?>')"><i class="fa-solid fa-trash"></i></span>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </thead>
            <tbody></tbody>
        </table>
        <div id="warnings" style="margin-left: 10px;">
            @if(session()->has('message'))
            <span style="color: green;" class="warning">{{ session()->get('message') }}</span>
            @endif
            <p style="color: red;" class="warning"></p>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/52bd1c8b9d.js" crossorigin="anonymous"></script>
    <script>
        function deleteStudent(id) {
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('delete.students') }}?data=" + encodedata;
        }

        function editStudent(id) {
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('edit.student') }}?data=" + encodedata;
        }

        function searchData() {
            let input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        window.onload = function() {
            var warnings = document.getElementsByClassName("warning");
            if (warnings) {
                setTimeout(() => {
                    for (i = 0; i < warnings.length; i++) {
                        warnings[i].textContent = "";
                    }
                }, 3000);
            }
        }
    </script>
</body>

</html>