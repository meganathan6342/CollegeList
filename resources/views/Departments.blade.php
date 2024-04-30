<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $college->college_name }} Departments</title>
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}" />
</head>

<body>
    <div id="mydiv">
        <h1>Departments of {{ $college->college_name }} </h1>
        <button id="btn1" class="btns">delete</button>
        <button id="btn2" class="btns">edit</button><br><br>
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll" onchange="toggleCheckboxes(this)"></th>
                    <th>No.</th>
                    <th>dept short code</th>
                    <th>Department Name</th>
                    <th>dept id</th>
                    <th>college Name</th>
                </tr>
            <tbody>
                <?php $a = 1; ?>
                @foreach($departments as $department)
                <tr>
                    <td><input type="checkbox" value="{{$department->dept_short_code}}" class="cb"></td>
                    <td><?php echo $a++ . '.'; ?></td>
                    <td>{{ $department->dept_short_code }}</td>
                    <td>{{ $department->dept_name }}</td>
                    <td>{{ $department->dept_id }}</td>
                    <td>{{ $department->colleges->college_name }}</td>
                </tr>
                @endforeach
            </tbody>
            </thead>
            <tbody></tbody>
        </table>
        <a href="{{ route('dept.form', ['id'=>$college->college_id]) }}">add new dept</a>
        <div id="warnings">
            @if(session()->has('message'))
            <span style="color: green;">{{ session()->get('message') }}</span>
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
                window.location.href = "{{ route('delete.depts') }}?data=" + encodedata;
                document.querySelector("p").textContent = "";
            } else {
                document.querySelector("p").textContent = "please select a department";
            }
        }, false);

        let edit = document.getElementById("btn2");
        edit.addEventListener("click", () => {
            var cval1;
            let cb = document.querySelectorAll('input[class="cb"]:checked');
            if (cb.length == 1) {
                cval1 = cb[0].value;
                document.querySelector("p").textContent = "";
                var jsondata = JSON.stringify(cval1);
                var encodedata = encodeURIComponent(jsondata);
                window.location.href = "{{ route('edit.dept') }}?data=" + encodedata;
            } else if (cb.length == 0) {
                document.querySelector("p").textContent = "please select a department";
            } else {
                document.querySelector("p").textContent = "please select one department at a time";
            }
        }, false);

        function toggleCheckboxes(main) {
            var checkboxes = document.querySelectorAll('input[class="cb"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = main.checked;
            });
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