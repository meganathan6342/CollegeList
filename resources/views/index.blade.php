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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>College Home Page</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
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
            <span style="font-size: 14px;">entries per page</span>
            <input type="text" id="search" onkeyup="searchData()" onblur="reload()" placeholder="Search">
            <button id="add-btn" class="submit" style="color: white;" onclick="addPopup()">add college</button><br><br>
            <table id="dataTable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th style="width: 300px;" onclick="shuffle(1)">College Name</th>
                        <th style="width: 300px;">Address</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody id="searchedData">
                    <?php $perPage = $colleges->perPage();
                    $currentPage = $colleges->currentPage();
                    $counter = ($currentPage - 1) * $perPage + 1; ?>
                    @forelse($colleges as $college)
                    <tr>
                        <td>{{ $counter++ }}.</td>
                        <td style="width: 300px;">{{ $college->college_name }}</td>
                        <td style="width: 300px;">
                            {{ $college->addresses->address_id }},
                            {{ $college->addresses->street_1 }},
                            {{ $college->addresses->street_2 }},
                            {{ $college->addresses->city }},
                            {{ $college->addresses->state }},
                            {{ $college->addresses->country }}
                        </td>
                        <td style="width: 150px;">
                            <span title="details" style="color: blue;margin-left: 30px;" id="toggleButton" onclick="collegeDetails('<?php echo $college->college_id ?>')"><i class="fa-regular fa-file-lines"></i></span>
                            <span title="edit" style="color: green;margin-left: 15px;" id="edit" onclick="editForm('<?php echo $college->college_id ?>'); addUpdatePopup();"><i class="fa-solid fa-pen-to-square"></i></span>
                            <span title="delete" style="color: red;margin-left: 15px;" id="delete" onclick="deleteClg('<?php echo $college->college_id ?>')"><i class="fa-solid fa-trash"></i></span>
                        </td>
                        <td class="college-details" data-college-id="{{ $college->college_id }}">
                            <ul>
                                <li><a href="{{ route('dept.details', ['id' => $college->college_id]) }}">Departments</a></li>
                                <li><a href="{{ route('staff.details', ['id' => $college->college_id]) }}">Staff's</a></li>
                                <li><a href="{{ route('student.details', ['id' => $college->college_id]) }}">Students</a></li>
                            </ul>
                        </td>
                    </tr>
                    @empty
                    <tr style="background-color: white;">
                        <td colspan="5" style="border-style: none; color: red;">No colleges are here..</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div id="footer">
                <span>Showing 1 to {{ count($colleges) }} of {{ $colleges->total() }}</span>
                <p id="pg-links">{{ $colleges->appends(['rowsPerPage' => $colleges->perPage()])->links() }} </p>
            </div>
        </div>
        <div id="warnings">
            @if(session()->has('message'))
            <span style="color: green;">{{ session()->get('message') }}</span>
            @endif
            @if(session()->has('error'))
            <span style="color: green;">{{ session()->get('error') }}</span>
            @endif
            <p style="color: red;" class="warning"></p>
            @if($errors->any())
            <ul id="validation-errors">
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
        <button onclick="closePopup()" class="close-btn" style="margin-bottom: 20px;">X</i></button>
        <form action="{{ route('submit.clg') }}" method="POST">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <td>College Name : </td>
                        <td><input type="text" id="inp11" class="inp" name="college_name" required onkeyup="alphabetValidation(this.value, 0)"></td>
                    </tr>
                    <tr>
                        <td class="al-msgs">alphabets only allowed</td>
                    </tr>
                    <tr>
                        <td>Street 1 : </td>
                        <td><input type="text" id="inp12" class="inp" name="street_1" required onkeyup="streetValidation(this.value, 0)"></td>
                    </tr>
                    <tr>
                        <td class="st-msgs">special chars not allowed</td>
                    </tr>
                    <tr>
                        <td>Street 2 : </td>
                        <td><input type="text" id="inp13" class="inp" name="street_2" placeholder="Optional" onkeyup="streetValidation(this.value, 1)"></td>
                    </tr>
                    <tr>
                        <td class="st-msgs">special chars not allowed</td>
                    </tr>
                    <tr>
                        <td>City : </td>
                        <td><input type="text" id="inp14" class="inp" name="city" required onkeyup="alphabetValidation(this.value, 1)"></td>
                    </tr>
                    <tr>
                        <td class="al-msgs">alphabets only allowed</td>
                    </tr>
                    <tr>
                        <td>State : </td>
                        <td><input type="text" id="inp15" class="inp" name="state" required onkeyup="alphabetValidation(this.value, 2)"></td>
                    </tr>
                    <tr>
                        <td class="al-msgs">alphabets only allowed</td>
                    </tr>
                    <tr>
                        <td>Country : </td>
                        <td><input type="text" id="inp16" class="inp" name="country" required onkeyup="alphabetValidation(this.value, 3)"></td>
                    </tr>
                    <tr>
                        <td class="al-msgs">alphabets only allowed</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;" colspan="2"><input type="submit" value="Submit" class="submit"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/52bd1c8b9d.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/validation.js') }}"></script>
    <script>
        function deleteClg(id) {
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('delete.clg') }}?data=" + encodedata;
        }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function editForm(id) {
            $(document).ready(function() {
                $.ajax({
                    url: "{{route('clg.form')}}",
                    type: 'POST',
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
                    url: "{{route('search.clg')}}",
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
            var url = "{{ route('index') }}" + "?rowsPerPage=" + perPage;
            window.location.href = url;
        }
    </script>
</body>

</html>