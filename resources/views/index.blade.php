<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Home Page</title>
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}" />
</head>

<body>
    <div id="home">
        <div id="mydiv">
            <h1>Welcome to Home page</h1>
            <select id="rowsPerPage" onchange="changePerPage()">
                <option value="5" {{ $colleges->perPage() == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $colleges->perPage() == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ $colleges->perPage() == 20 ? 'selected' : '' }}>20</option>
            </select>
            <span style="font-size: 16px;">entries per page</span>
            <input type="text" id="search" onkeyup="searchData()" placeholder="Search">
            <button id="add-btn"><a href="{{ route('colleges') }}">add college</a></button><br><br>
            <table id="dataTable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th style="width: 300px;" onclick="shuffle(1)">College</th>
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
            <div id="footer">
                <span>Showing 1 to {{ count($colleges) }} of {{ $colleges->total() }}</span>
                <p id="pg-links">{{ $colleges->appends(['rowsPerPage' => $colleges->perPage()])->links() }} </p>
            </div>
        </div>
        <div id="warnings">
            @if(session()->has('message'))
            <span style="color: green;" class="warning">{{ session()->get('message') }}</span>
            @endif
            <p style="color: red;" class="warning"></p>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/52bd1c8b9d.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
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

        function changePerPage() {
            var perPage = document.getElementById('rowsPerPage').value;
            var url = "{{ route('index') }}" + "?rowsPerPage=" + perPage;
            window.location.href = url;
        }
    </script>
</body>

</html>