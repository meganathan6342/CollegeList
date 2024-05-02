<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $college->college_name }} Staff's</title>
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}" />
</head>

<body>
    <div id="mydiv" style="margin-left: 3px;">
        <h1>Staff's of {{ $college->college_name }} </h1>
        <input type="text" id="search" onkeyup="searchData()" placeholder="Search" style="margin-left: 940px;">
        <button id="add-btn"><a href="{{ route('staffs.form', ['id'=>$college->college_id]) }}">add staff</a></button><br><br>
        <table id="dataTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="width: 150px;" onclick="shuffle(1)">Staff Name</th>
                    <th style="width: 100px;">Staff ID</th>
                    <th style="width: 80px;">Staff Gender</th>
                    <th style="width: 80px;">Staff DOB</th>
                    <th style="width: 150px;">Staff Mobile no.</th>
                    <th style="width: 200px;">Staff Address</th>
                    <th style="width: 150px;">College Name</th>
                    <th style="width: 100px;">Staff Dept Name</th>
                    <th style="width: 80px;">Action</th>
                </tr>
            <tbody>
                <?php $a = 1; ?>
                @foreach($staffs as $staff)
                <tr>
                    <td><?php echo $a++; ?></td>
                    <td style="width: 150px;">{{ $staff->staff_name }}</td>
                    <td style="width: 100px;">{{ $staff->staff_id }}</td>
                    <td style="width: 80px;">{{ $staff->staff_gender }}</td>
                    <td style="width: 80px;">{{ \Carbon\Carbon::parse($staff->staff_dob)->age }}</td>
                    <td style="width: 150px;">{{ $staff->mobile_no }}</td>
                    <td style="width: 200px;">{{ $staff->addresses->address_id }},
                        {{ $staff->addresses->street_1 }},
                        {{ $staff->addresses->street_2 }},
                        {{ $staff->addresses->city }},
                        {{ $staff->addresses->state }},
                        {{ $staff->addresses->country }}
                    </td>
                    <td style="width: 150px;">{{ $staff->colleges->college_name }}</td>
                    <td style="width: 100px;">{{ $staff->departments->dept_name }}</td>
                    <td style="width: 80px;">
                        <span title="edit" style="color: green;margin-left: 20px;" id="edit" onclick="editStaff('<?php echo $staff->staff_id ?>')"><i class="fa-solid fa-pen-to-square"></i></span>
                        <span title="delete" style="color: red;margin-left: 10px;" id="delete" onclick="deleteStaff('<?php echo $staff->staff_id ?>')"><i class="fa-solid fa-trash"></i></span>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </thead>
            <tbody></tbody>
        </table>
        <div id="warnings">
            @if(session()->has('message'))
            <span style="color: green;" class="warning">{{ session()->get('message') }}</span>
            @endif
            <p style="color: red;" class="warning"></p>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/52bd1c8b9d.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        function deleteStaff(id) {
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('delete.staffs') }}?data=" + encodedata;
        }

        function editStaff(id) {
            var jsondata = JSON.stringify(id);
            var encodedata = encodeURIComponent(jsondata);
            window.location.href = "{{ route('edit.staff') }}?data=" + encodedata;
        }
    </script>
</body>

</html>