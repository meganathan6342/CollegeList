<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $college->college_name }} Staff's</title>
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}" />
</head>

<body>
    <div id="mydiv" style="margin-left: 3px;">
        <h1>Staff's of {{ $college->college_name }} </h1>
        <button id="btn1" class="btns">delete</button>
        <button id="btn2" class="btns">edit</button><br><br>
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll" onchange="toggleCheckboxes(this)"></th>
                    <th>No.</th>
                    <th>Staff ID</th>
                    <th>Staff Name</th>
                    <th>Staff Gender</th>
                    <th>Staff DOB</th>
                    <th>Staff Mobile no.</th>
                    <th>Staff Address</th>
                    <th>College Name</th>
                    <th>Staff Dept Name</th>
                </tr>
            <tbody>
                <?php $a = 1; ?>
                @foreach($staffs as $staff)
                <tr>
                    <td><input type="checkbox" value="{{$staff->staff_id}}" class="cb"></td>
                    <td><?php echo $a++; ?></td>
                    <td>{{ $staff->staff_id }}</td>
                    <td>{{ $staff->staff_name }}</td>
                    <td>{{ $staff->staff_gender }}</td>
                    <td>{{ \Carbon\Carbon::parse($staff->staff_dob)->age }}</td>
                    <td>{{ $staff->mobile_no }}</td>
                    <td style="width: 200px;">{{ $staff->addresses->address_id }},
                        {{ $staff->addresses->street_1 }},
                        {{ $staff->addresses->street_2 }},
                        {{ $staff->addresses->city }},
                        {{ $staff->addresses->state }},
                        {{ $staff->addresses->country }}
                    </td>
                    <td>{{ $staff->colleges->college_name }}</td>
                    <td>{{ $staff->departments->dept_name }}</td>
                </tr>
                @endforeach
            </tbody>
            </thead>
            <tbody></tbody>
        </table>
        <a href="{{ route('staffs.form', ['id'=>$college->college_id]) }}">add new staff</a>
        <div id="warnings">
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
                window.location.href = "{{ route('delete.staffs') }}?data=" + encodedata;
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
                window.location.href = "{{ route('edit.staff') }}?data=" + encodedata;
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