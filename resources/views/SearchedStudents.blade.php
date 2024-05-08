<div>
    <tbody>
        <?php $a = 1; ?>
        @forelse($students as $student)
        <tr>
            <td><?php $a++ . '.'; ?></td>
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
            <td colspan="5" style="border-style: none; color: red;">No matches are here..</td>
        </tr>
        @endforelse
    </tbody>
</div>