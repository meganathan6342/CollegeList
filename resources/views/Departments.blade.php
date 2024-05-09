<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $college->college_name }} Departments</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/Departments.css') }}" />
</head>

<body>
    <div id="mydiv">
        <h3>Departments of {{ $college->college_name }} </h3>
        <select id="rowsPerPage" onchange="changePerPage()">
            <option value="5" {{ $departments->perPage() == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ $departments->perPage() == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ $departments->perPage() == 20 ? 'selected' : '' }}>20</option>
        </select>
        <span style="font-size: 14px;">entries per page</span>
        <input type="text" id="search" onkeyup="searchData()" onblur="reload()" placeholder="Search">
        <button id="add-btn" class="submit" onclick="addPopup()">add dept</button><br><br>
        <table id="dataTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="width: 200px;" onclick="shuffle(1)">Department Name</th>
                    <th>dept short code</th>
                    <th style="width: 300px;">college Name</th>
                    <th style="width: 100px;">Action</th>
                </tr>
            </thead>
            <tbody id="searchedData">
                <?php $perPage = $departments->perPage();
                $currentPage = $departments->currentPage();
                $counter = ($currentPage - 1) * $perPage + 1; ?>
                @forelse($departments as $department)
                <tr>
                    <td>{{ $counter++ }}.</td>
                    <td style="width: 200px;">{{ $department->dept_name }}</td>
                    <td>{{ $department->dept_short_code }}</td>
                    <td style="width: 300px;">{{ $department->colleges->college_name }}</td>
                    <td style="width: 100px;">
                        <span title="edit" style="color: green;margin-left: 20px;" id="edit" onclick="editForm('<?php echo $department->dept_short_code ?>'); addUpdatePopup();"><i class="fa-solid fa-pen-to-square"></i></span>
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
        <div id="footer">
            <span>Showing 1 to {{ count($departments) }} of {{ $departments->total() }}</span>
            <p id="pg-links">{{ $departments->appends(['rowsPerPage' => $departments->perPage()])->links() }} </p>
        </div>
        <div id="warnings">
            @if(session()->has('message'))
            <span style="color: green;">{{ session()->get('message') }}</span>
            @endif
            @if(session()->has('error'))
            <span style="color: red;">{{ session()->get('error') }}</span>
            @endif
            <p style="color: red;" class="warning"></p>
            @if($errors->any())
            <ul style="color: red;">
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
        <button onclick="closePopup()" class="close-btn">X</i></button>
        <form action="{{ route('submit.dept') }}" method="POST">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <td><input type="text" name="college_id" value="{{ $college->college_id }}" style="visibility: hidden;" required></td>
                    </tr>
                    <tr>
                        <td>Department Name : </td>
                        <td><input type="text" name="dept_name" required id="inp11" onkeyup="deptNameValidation(this.value)"></td>
                    </tr>
                    <tr>
                        <td class="dept-msg" style="visibility: hidden; color: red;">alphabets only allowed</td>
                    </tr>
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
    <script src="{{ asset('js/validation.js') }}"></script>
    <script>
        function deleteDept(id) {
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('delete.dept') }}?data=" + encodedata;
        }

        function editForm(id) {
            $(document).ready(function() {
                $.ajax({
                    url: "{{route('dept.form')}}",
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

        function searchData() {
            let val = document.getElementById("search").value;
            $(document).ready(function() {
                $.ajax({
                    url: "{{route('search.dept')}}",
                    type: 'GET',
                    data: {
                        data: val
                    },
                    success: function(response) {
                        $('#searchedData').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        }

        function changePerPage() {
            var perPage = document.getElementById('rowsPerPage').value;
            var url = "{{ route('dept.details', $college->college_id) }}" + "?rowsPerPage=" + perPage;
            window.location.href = url;
        }
    </script>
</body>

</html>