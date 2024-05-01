<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $college->college_name }} Departments</title>
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
            margin-left: 590px;
            height: 23px;
        }
    </style>
</head>

<body>
    <div id="mydiv">
        <h1>Departments of {{ $college->college_name }} </h1>
        <input type="text" id="search" onkeyup="searchData()" placeholder="Search">
        <button id="add-btn"><a href="{{ route('dept.form', ['id'=>$college->college_id]) }}">add dept</a></button><br><br>
        <table id="dataTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>dept short code</th>
                    <th style="width: 200px;">Department Name</th>
                    <th>dept id</th>
                    <th style="width: 200px;">college Name</th>
                    <th>Action</th>
                </tr>
            <tbody>
                <?php $a = 1; ?>
                @foreach($departments as $department)
                <tr>
                    <td><?php echo $a++ . '.'; ?></td>
                    <td>{{ $department->dept_short_code }}</td>
                    <td style="width: 200px;">{{ $department->dept_name }}</td>
                    <td>{{ $department->dept_id }}</td>
                    <td style="width: 200px;">{{ $department->colleges->college_name }}</td>
                    <td>
                        <span style="color: green;margin-left: 30px;" id="edit" onclick="editDept('<?php echo $department->dept_short_code ?>')"><i class="fa-solid fa-pen-to-square"></i></span>
                        <span style="color: red;margin-left: 10px;" id="delete" onclick="deleteDept('<?php echo $department->dept_short_code ?>')"><i class="fa-solid fa-trash"></i></span>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </thead>
            <tbody></tbody>
        </table>
        <div id="warnings">
            @if(session()->has('message'))
            <span style="color: green;">{{ session()->get('message') }}</span>
            @endif
            <p style="color: red;" class="warning"></p>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/52bd1c8b9d.js" crossorigin="anonymous"></script>
    <script>
        function deleteDept(id) {
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('delete.depts') }}?data=" + encodedata;
        }

        function editDept(id) {
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('edit.dept') }}?data=" + encodedata;
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