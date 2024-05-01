<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Home Page</title>
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
            margin-left: 330px;
            height: 23px;
        }

        .college-details {
            position: absolute;
            left: 400px;
            border-style: none;
            background-color: rgb(200, 200, 200);
            padding: 0px 5px;
            min-width: 200px;
            border-radius: 5px;
            visibility: hidden;
        }
    </style>
</head>

<body>
    <div id="home">
        <div id="mydiv">
            <h1>Welcome to Home page</h1>
            <select name="" id="">
                <option value="10">5</option>
                <option value="20">10</option>
                <option value="15">15</option>
            </select> <span style="font-size: 16px;">entries per page</span>
            <input type="text" id="search" onkeyup="searchData()" placeholder="Search">
            <button id="add-btn"><a href="{{ route('colleges') }}">add college</a></button><br><br>
            <table id="dataTable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th style="width: 300px;">College</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $a = 1; ?>
                    @foreach($colleges as $college)
                    <tr>
                        <td><?php echo $a++ . '.'; ?></td>
                        <td style="width: 300px;">{{ $college->college_name }}</td>
                        <td style="width: 200px;">
                            {{ $college->addresses->address_id }},
                            {{ $college->addresses->street_1 }},
                            {{ $college->addresses->street_2 }},
                            {{ $college->addresses->city }},
                            {{ $college->addresses->state }},
                            {{ $college->addresses->country }}
                        </td>
                        <td>
                            <span style="color: blue;margin-left: 40px;" onclick="collegeDetails('<?php echo $college->college_id ?>')"><i class="fa-regular fa-file-lines"></i></span>
                            <span style="color: green;margin-left: 10px;" id="edit" onclick="editCollege('<?php echo $college->college_id ?>')"><i class="fa-solid fa-pen-to-square"></i></span>
                            <span style="color: red;margin-left: 10px;" id="delete" onclick="deleteCollege('<?php echo $college->college_id ?>')"><i class="fa-solid fa-trash"></i></span>
                        </td>
                        <td class="college-details" data-college-id="{{ $college->college_id }}">
                            <ul>
                                <li><a href="{{ route('dept.details', ['id' => $college->college_id]) }}">Departments</a></li>
                                <li><a href="{{ route('staffs.details', ['id' => $college->college_id]) }}">Staff's</a></li>
                                <li><a href="{{ route('students.details', ['id' => $college->college_id]) }}">Students</a></li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="warnings">
            @if(session()->has('message'))
            <span style="color: green;" class="warning">{{ session()->get('message') }}</span>
            @endif
            <p style="color: red;" class="warning"></p>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/52bd1c8b9d.js" crossorigin="anonymous"></script>
    <script>
        function deleteCollege(id) {
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('delete.colleges') }}?data=" + encodedata;
        }

        function editCollege(id) {
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('edit.college') }}?data=" + encodedata;
        }

        let isVisible = false;

        function collegeDetails(collegeId) {
            let collegeDetails = document.querySelectorAll('.college-details');
            collegeDetails.forEach(function(cd) {
                if (cd.getAttribute('data-college-id') === collegeId) {
                    if (!isVisible) {
                        cd.style.visibility = 'visible';
                        isVisible = true;
                    } else {
                        cd.style.visibility = 'hidden';
                        isVisible = false;
                    }
                }
            });
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