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
    <title>{{ $college->college_name }} Students</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/Staff_Student.css') }}" />
</head>

<body>
    <div id="mydiv">
        <h3>Students of {{ $college->college_name }} </h3>
        <select id="rowsPerPage" onchange="changePerPage()">
            <option value="5" {{ $students->perPage() == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ $students->perPage() == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ $students->perPage() == 20 ? 'selected' : '' }}>20</option>
        </select>
        <input type="text" id="search" onkeyup="searchData()" placeholder="Search">
        <button id="add-btn" class="submit" onclick="addPopup()">add student</button><br><br>
        <table id="dataTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="width: 150px;">Student ID</th>
                    <th style="width: 170px;" onclick="shuffle(1)">Student Name</th>
                    <th style="width: 60px;">Student Gender</th>
                    <th style="width: 60px;">Student DOB</th>
                    <th style="width: 150px;">Student Mobile no.</th>
                    <th style="width: 200px;">Student Address</th>
                    <th style="width: 200px;">College Name</th>
                    <th style="width: 100px;">Student Dept Name</th>
                    <th style="width: 100px;">Action</th>
                </tr>
            </thead>
            <tbody id="searchedData">
                <?php $perPage = $students->perPage();
                $currentPage = $students->currentPage();
                $counter = ($currentPage - 1) * $perPage + 1; ?>
                @forelse($students as $student)
                <tr>
                    <td>{{ $counter++ }}.</td>
                    <td style="width: 150px;">{{ $student->student_id }}</td>
                    <td style="width: 170px;">{{ $student->student_name }}</td>
                    <td style="width: 60px;">{{ $student->student_gender }}</td>
                    <td style="width: 60px;">{{ \Carbon\Carbon::parse($student->student_dob)->age }}</td>
                    <td style="width: 150px;">{{ $student->mobile_no }}</td>
                    <td style="max-width: 200px;">
                        {{ $student->addresses->address_id }},
                        {{ $student->addresses->street_1 }},
                        {{ $student->addresses->street_2 }},
                        {{ $student->addresses->city }},
                        {{ $student->addresses->state }},
                        {{ $student->addresses->country }}
                    </td>
                    <td style="width: 200px;">{{ $student->colleges->college_name }}</td>
                    <td style="width: 100px;">{{ $student->departments->dept_name }}</td>
                    <td style="width: 100px;">
                        <span title="edit" style="color: green;margin-left: 20px;" id="edit" onclick="editForm('<?php echo $student->student_id ?>'); addUpdatePopup();"><i class="fa-solid fa-pen-to-square"></i></span>
                        <span title="delete" style="color: red;margin-left: 10px;" id="delete" onclick="deleteStudent('<?php echo $student->student_id ?>')"><i class="fa-solid fa-trash"></i></span>
                    </td>
                </tr>
                @empty
                <tr style="background-color: white;">
                    <td colspan="5" style="border-style: none; color: red;">No students are here..</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div id="footer">
            <span>Showing 1 to {{ count($students) }} of {{ $students->total() }}</span>
            <p id="pg-links">{{ $students->appends(['rowsPerPage' => $students->perPage()])->links() }} </p>
        </div>
        <div id="warnings">
            @if(session()->has('message'))
            <span style="color: green;" class="warning">{{ session()->get('message') }}</span>
            @endif
            @if(session()->has('error'))
            <span style="color: red;" class="warning">{{ session()->get('error') }}</span>
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
        <form action="{{ route('submit.student') }}" method="POST">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <td><input type="tel" name="college_id" value="{{ $college->college_id }}" style="visibility: hidden;"></td>
                    </tr>
                    <tr>
                        <td>Student Name : </td>
                        <td><input type="text" id="inp11" class="inp" name="student_name" required onkeyup="alphabetValidation(this.value, 0)"></td>
                    </tr>
                    <tr>
                        <td class="al-msgs">alphabets only allowed</td>
                    </tr>
                    <tr>
                        <td>Student Gender : </td>
                        <td><input type="radio" name="student_gender" value="M" required> : Male <input type="radio" name="student_gender" value="F"> : Female <input type="radio" name="student_gender" value="O"> : Others</td>
                    </tr>
                    <tr>
                        <td>Student DOB : </td>
                        <td><input type="date" id="dob1" class="inp" name="student_dob" required onblur="calculateAge(this)"><span style="margin-left: 8px;"></span></td>
                    </tr>
                    <tr>
                        <td class="dob-msgs">select valid age</td>
                    </tr>
                    <tr>
                        <td>Student Mobile no. : </td>
                        <td><input type="tel" id="mobile-no1" class="inp" name="mobile_no" required onchange="mobileNumberValidation(this)"></td>
                    </tr>
                    <tr>
                        <td class="mob-msgs">please enter valid mobile number</td>
                    </tr>
                    <tr>
                        <td>Street 1 : </td>
                        <td><input type="text" id="inp12" class="inp" name="street_1" required onkeyup="streetValidation(this.value, 0)"></td>
                    </tr>
                    <tr>
                        <td class="st-msgs">special char not allowed</td>
                    </tr>
                    <tr>
                        <td>Street 2 : </td>
                        <td><input type="text" id="inp13" class="inp" name="street_2" placeholder="Optional" onkeyup="streetValidation(this.value, 1)"></td>
                    </tr>
                    <tr>
                        <td class="st-msgs">special char not allowed</td>
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
                        <td>Student dept short code : </td>
                        <td>
                            <select name="dept_short_code" id="dsc" required>
                                @foreach($departments as $department)
                                <option value="{{$department->dept_short_code}}">{{ $department->dept_name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right; padding-right: 20px;"><input type="submit" value="Submit" class="submit"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/52bd1c8b9d.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/validation.js') }}"></script>
    <script>
        function deleteStudent(id) {
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('delete.student') }}?data=" + encodedata;
        }

        function editForm(id) {
            $(document).ready(function() {
                $.ajax({
                    url: "{{route('student.form')}}",
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
                    url: "{{route('search.student')}}",
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
            var url = "{{ route('student.details', $college->college_id) }}" + "?rowsPerPage=" + perPage;
            window.location.href = url;
        }
    </script>
</body>

</html>