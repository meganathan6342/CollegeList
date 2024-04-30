<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $college->college_name }} Students</title>
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}" />
</head>

<body>
    <div id="mydiv" style="margin-left: 3px;">
        <h1>Students of {{ $college->college_name }} </h1>
        <button id="btn1" class="btns">delete</button>
        <button id="btn2" class="btns">edit</button><br><br>
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll" onchange="toggleCheckboxes(this)"></th>
                    <th>No.</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Student Gender</th>
                    <th>Student DOB</th>
                    <th>Student Mobile no.</th>
                    <th>Student Address</th>
                    <th>College Name</th>
                    <th>Student Dept Name</th>
                </tr>
            <tbody>
                <?php $a = 1; ?>
                @foreach($students as $student)
                <tr>
                    <td><input type="checkbox" value="{{$student->student_id}}" class="cb"></td>
                    <td><?php echo $a++; ?></td>
                    <td>{{ $student->student_id }}</td>
                    <td>{{ $student->student_name }}</td>
                    <td>{{ $student->student_gender }}</td>
                    <td>{{ \Carbon\Carbon::parse($student->student_dob)->age }}</td>
                    <td>{{ $student->mobile_no }}</td>
                    <td style="max-width: 200px;">
                        {{ $student->addresses->address_id }},
                        {{ $student->addresses->street_1 }},
                        {{ $student->addresses->street_2 }},
                        {{ $student->addresses->city }},
                        {{ $student->addresses->state }},
                        {{ $student->addresses->country }}
                    </td>
                    <td>{{ $student->colleges->college_name }}</td>
                    <td>{{ $student->departments->dept_name }}</td>
                </tr>
                @endforeach
            </tbody>
            </thead>
            <tbody></tbody>
        </table>
        <a href="{{ route('students.form', ['id'=>$college->college_id]) }}">add new student</a>
        <div id="warnings" style="margin-left: 10px;">
            @if(session()->has('message'))
            <span style="color: green;" class="warning">{{ session()->get('message') }}</span>
            @endif
            <p style="color: red;" class="warning"></p>
        </div>
    </div>
    <script>
        let del = document.getElementById("btn1");
        del.addEventListener("click", () => {
            var cval = [];
            let cb = document.querySelectorAll('input[class="cb"]:checked');
            for (i = 0; i < cb.length; i++) {
                cval.push(cb[i].value);
            }
            if (cb.length > 0) {
                var jsondata = JSON.stringify(cval);
                var encodedata = encodeURIComponent(jsondata);
                window.location.href = "{{ route('delete.students') }}?data=" + encodedata;
                document.querySelector("p").textContent = "";
            } else {
                document.querySelector("p").textContent = "please select a detail";
            }
        }, false);

        function toggleCheckboxes(main) {
            var checkboxes = document.querySelectorAll('input[class="cb"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = main.checked;
            });
        }
        let edit = document.getElementById("btn2");
        edit.addEventListener("click", () => {
            var cval1;
            let cb = document.querySelectorAll('input[class="cb"]:checked');
            if (cb.length == 1) {
                cval1 = cb[0].value;
                document.querySelector("p").textContent = "";
                var jsondata = JSON.stringify(cval1);
                var encodedata = encodeURIComponent(jsondata);
                window.location.href = "{{ route('edit.student') }}?data=" + encodedata;
            } else if (cb.length == 0) {
                document.querySelector("p").textContent = "please select a detail";
            } else {
                document.querySelector("p").textContent = "please select one detail at a time";
            }
        }, false);

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