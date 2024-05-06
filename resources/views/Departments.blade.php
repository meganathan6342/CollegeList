<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $college->college_name }} Departments</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div id="mydiv">
        <h1>Departments of {{ $college->college_name }} </h1>
        <input type="text" id="search" onkeyup="searchData()" placeholder="Search" style="margin-left: 550px;">
        <button id="add-btn" class="submit" style="color: white;" onclick="addPopup()">add dept</button><br><br>
        <table id="dataTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="width: 200px;" onclick="shuffle(1)">Department Name</th>
                    <th>dept short code</th>
                    <th style="width: 200px;">college Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $a = 1; ?>
                @forelse($departments as $department)
                <tr>
                    <td><?php echo $a++ . '.'; ?></td>
                    <td style="width: 200px;">{{ $department->dept_name }}</td>
                    <td>{{ $department->dept_short_code }}</td>
                    <td style="width: 200px;">{{ $department->colleges->college_name }}</td>
                    <td>
                        <span title="edit" style="color: green;margin-left: 30px;" id="edit" onclick="editForm('<?php echo $department->dept_short_code ?>'); addUpdatePopup();"><i class="fa-solid fa-pen-to-square"></i></span>
                        <span title="delete" style="color: red;margin-left: 10px;" id="delete" onclick="deleteDept('<?php echo $department->dept_short_code ?>')"><i class="fa-solid fa-trash"></i></span>
                    </td>
                </tr>
                @empty
                <tr style="background-color: white;">
                    <td colspan="5" style="border-style: none; color: red;">No departments are here..</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div id="warnings">
            @if(session()->has('message'))
            <span style="color: green;">{{ session()->get('message') }}</span>
            @endif
            <p style="color: red;" class="warning"></p>
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <div id="backDrop"></div>
    <div id="updateForm" class="forms"></div>
    <div id="addForm" class="forms">
    <button onclick="closePopup()" class="close">X</i></button>
        <form action="{{ route('submit.dept') }}" method="POST">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <td><input type="tel" name="college_id" value="{{ $college->college_id }}" style="visibility: hidden;" required></td>
                    </tr>
                    <tr>
                        <td>Department Name : </td>
                        <td><input type="text" name="dept_name" required id="inp11"></td>
                    </tr>
                    <tr><td id="msg11" style="visibility: hidden; color: red;">alphabets only allowed</td></tr>
                    <tr>
                        <td></td>
                        <td style="text-align: right;"><input type="submit" value="Submit" class="submit"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/52bd1c8b9d.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        function deleteDept(id) {
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('delete.depts') }}?data=" + encodedata;
        }

        function editForm(id) {
            $(document).ready(function() {
                $.ajax({
                    url: "{{route('dept.form')}}",
                    type: 'GET',
                    data: {data: id},
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