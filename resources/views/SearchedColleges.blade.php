<div>
    <tbody>
        @forelse($colleges as $college)
        <tr>
            <td>{{ $college->college_id }}</td>
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
                <span title="details" style="color: blue;margin-left: 40px;" onclick="collegeDetails('<?php echo $college->college_id ?>')"><i class="fa-regular fa-file-lines"></i></span>
                <span title="edit" style="color: green;margin-left: 30px;" id="edit" onclick="editForm('<?php echo $college->college_id ?>'); addUpdatePopup();"><i class="fa-solid fa-pen-to-square"></i></span>
                <span title="delete" style="color: red;margin-left: 10px;" id="delete" onclick="deleteClg('<?php echo $college->college_id ?>')"><i class="fa-solid fa-trash"></i></span>
            </td>
            <td class="college-details" data-college-id="{{ $college->college_id }}">
                <ul>
                    <li><a href="{{ route('dept.details', ['id' => $college->college_id]) }}">Departments</a></li>
                    <li><a href="{{ route('staffs.details', ['id' => $college->college_id]) }}">Staff's</a></li>
                    <li><a href="{{ route('students.details', ['id' => $college->college_id]) }}">Students</a></li>
                </ul>
            </td>
        </tr>
        @empty
        <tr style="background-color: white;">
            <td colspan="5" style="border-style: none; color: red;">No matched results are here..</td>
        </tr>
        @endforelse
    </tbody>
</div>