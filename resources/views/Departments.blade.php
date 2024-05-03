<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $college->college_name }} Departments</title>
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/form.css') }}" />
</head>

<body>
    <div id="mydiv">
        <h1>Departments of {{ $college->college_name }} </h1>
        <input type="text" id="search" onkeyup="searchData()" placeholder="Search" style="margin-left: 600px;">
        <button id="add-btn" style="color: white;">add dept</button><br><br>
        <table id="dataTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="width: 200px;" onclick="shuffle(1)">Department Name</th>
                    <th>dept short code</th>
                    <th>dept id</th>
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
                    <td>{{ $department->dept_id }}</td>
                    <td style="width: 200px;">{{ $department->colleges->college_name }}</td>
                    <td>
                        <span title="edit" style="color: green;margin-left: 30px;" id="edit" onclick="editDept('<?php echo $department->dept_short_code ?>')"><i class="fa-solid fa-pen-to-square"></i></span>
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
        </div>
    </div>
    <div id="backdrop" class="backdrop" style="display:none;"></div>
    <div id="form" style="display: none;">
        @if(isset($department))
        <h3>Department Update Form</h3>
        <form action="{{ route('editing.dept', $department->dept_short_code)}}" method="POST">
            @csrf
            @method('PUT')
            <table>
                <tbody>
                    <tr>
                        <td>Department Name : </td>
                        <td><input type="text" id="inp1" name="dept_name" value="{{ $department->dept_name }}" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;"><input type="submit" value="Update" class="submit"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        @else
        <h3>Department Form</h3>
        <form action="{{ route('submit.dept') }}" method="POST">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <td><input type="tel" name="college_id" value="{{ $college->college_id }}" style="visibility: hidden;" required></td>
                    </tr>
                    <tr>
                        <td>Department Name : </td>
                        <td><input type="text" name="dept_name" required></td>
                    </tr>
                    <tr>
                        <td><button class="submit" onclick="closePopup()">Close</button></td>
                        <td style="text-align: right;"><input type="submit" value="Submit" class="submit"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        @endif
        @if(session()->has('message'))
        <p style="color: green;">{{ session()->get('message') }}</p>
        @endif
    </div>
    <script src="https://kit.fontawesome.com/52bd1c8b9d.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/form.js') }}"></script>
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
    </script>
</body>

</html>