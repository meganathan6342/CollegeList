<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Home Page</title>
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}" />
    <style>
        th:nth-last-child(-n+4) {
            visibility: hidden;
            border-style: none;
        }
        td:nth-last-child(-n+4) {
            visibility: hidden;
            border-style: none;
        }
        .btns{
            visibility: hidden;
        }
    </style>
</head>

<body>
    <div id="mydiv">
        <h1>Welcome to Home page</h1>
        <!-- <button id="btn1" class="btns">delete</button>
        <button id="btn2" class="btns">edit</button> -->
        <table>
            <thead>
            <span id="settings" style="margin-left: 550px;"><i class="fa-solid fa-gear fa-2x"></i></span><br><br>
            <span id="btn1" class="btns" style="margin-right: 20px; margin-left: 540px;"><i class="fa-solid fa-trash"></i></span>
            <span id="btn2" class="btns"><i class="fa-solid fa-pen-to-square"></i></span><br><br>
                <tr>
                    <th>No.</th>
                    <th>College</th>
                    <th>Address</th>
                    <th>Department</th>
                    <th>Staff's</th>
                    <th>Students</th>
                    <th><input type="checkbox" id="selectAll" onchange="toggleCheckboxes(this)"></th>
                </tr>
            </thead>
            <tbody>
                <?php $a = 1; ?>
                @foreach($colleges as $college)
                <tr>
                    <td><?php echo $a++ . '.'; ?></td>
                    <td>{{ $college->college_name }}</td>
                    <td style="width: 200px;">
                        {{ $college->addresses->address_id }},
                        {{ $college->addresses->street_1 }},
                        {{ $college->addresses->street_2 }},
                        {{ $college->addresses->city }},
                        {{ $college->addresses->state }},
                        {{ $college->addresses->country }}
                    </td>
                    <td><a href="{{ route('dept.details', ['id' => $college->college_id]) }}">Departments</a></td>
                    <td><a href="{{ route('staffs.details', ['id' => $college->college_id]) }}">Staff's</a></td>
                    <td><a href="{{ route('students.details', ['id' => $college->college_id]) }}">Students</a></td>
                    <td><input type="checkbox" value="{{$college->college_id}}" class="cb"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('colleges') }}">add college</a>
    </div>
    <div id="warnings">
        @if(session()->has('message'))
        <span style="color: green;" class="warning">{{ session()->get('message') }}</span>
        @endif
        <p style="color: red;" class="warning"></p>
    </div>
    <script src="https://kit.fontawesome.com/52bd1c8b9d.js" crossorigin="anonymous"></script>
    <script>
        let del = document.getElementById("btn1");
        del.addEventListener("click", () => {
            var cval = [];
            let cb = document.querySelectorAll('input[class="cb"]:checked');
            for (i = 0; i < cb.length; i++) {
                cval.push(Number(cb[i].value));
            }
            if (cb.length > 0) {
                var jsondata = JSON.stringify(cval);
                var encodedata = encodeURIComponent(jsondata);
                window.location.href = "{{ route('delete.colleges') }}?data=" + encodedata;
                document.querySelector("p").textContent = "";
            } else {
                document.querySelector("p").textContent = "please select a college";
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
                window.location.href = "{{ route('edit.college') }}?data=" + encodedata;
            } else if (cb.length == 0) {
                document.querySelector("p").textContent = "please select a college";
            } else {
                document.querySelector("p").textContent = "please select one college at a time";
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
        let b = 0;
        let settings = document.getElementById("settings");
        settings.addEventListener("click", () => {
            if(b == 0) {
                let th = document.querySelectorAll("th:nth-last-child(-n+4)");
                for(i = 0; i < th.length; i++) {
                    th[i].style.visibility = "visible";
                    th[i].style.border = "1px solid black"
                }
                let td = document.querySelectorAll("td:nth-last-child(-n+4)");
                for(i = 0; i < td.length; i++) {
                    td[i].style.visibility = "visible";
                    td[i].style.borderBottom = "1px solid black"
                }
                let btns = document.getElementsByClassName("btns");
                for(i = 0; i < btns.length; i++) {
                    btns[i].style.visibility = "visible";
                }
                b = 1;
            }
            else {
                let th = document.querySelectorAll("th:nth-last-child(-n+4)");
                for(i = 0; i < th.length; i++) {
                    th[i].style.visibility = "hidden";
                    th[i].style.borderStyle = "none";
                }
                let td = document.querySelectorAll("td:nth-last-child(-n+4)");
                for(i = 0; i < td.length; i++) {
                    td[i].style.visibility = "hidden";
                    td[i].style.borderStyle = "none";
                }
                let btns = document.getElementsByClassName("btns");
                for(i = 0; i < btns.length; i++) {
                    btns[i].style.visibility = "hidden";
                }
                b = 0;
            }
        })
    </script>
</body>

</html>