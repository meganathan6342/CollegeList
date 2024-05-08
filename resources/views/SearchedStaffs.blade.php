<div>
    <tbody>
        <?php $a = 1; ?>
        @forelse($staffs as $staff)
        <tr>
            <td><?php echo $a++ . '.'; ?></td>
            <td style="width: 150px;">{{ $staff->staff_id }}</td>
            <td style="width: 170px;">{{ $staff->staff_name }}</td>
            <td style="width: 60px;">{{ $staff->staff_gender }}</td>
            <td style="width: 60px;">{{ \Carbon\Carbon::parse($staff->staff_dob)->age }}</td>
            <td style="width: 150px;">{{ $staff->mobile_no }}</td>
            <td style="width: 200px;">{{ $staff->addresses->address_id }},
                {{ $staff->addresses->street_1 }},
                {{ $staff->addresses->street_2 }},
                {{ $staff->addresses->city }},
                {{ $staff->addresses->state }},
                {{ $staff->addresses->country }}
            </td>
            <td style="width: 200px;">{{ $staff->colleges->college_name }}</td>
            <td style="width: 100px;">{{ $staff->departments->dept_name }}</td>
            <td style="width: 100px;">
                <span title="edit" style="color: green;margin-left: 20px;" id="edit" onclick="editForm('<?php echo $staff->staff_id ?>'); addUpdatePopup();"><i class="fa-solid fa-pen-to-square"></i></span>
                <span title="delete" style="color: red;margin-left: 10px;" id="delete" onclick="deleteStaff('<?php echo $staff->staff_id ?>')"><i class="fa-solid fa-trash"></i></span>
            </td>
        </tr>
        @empty
        <tr style="background-color: white;">
            <td colspan="5" style="border-style: none; color: red;">No matched are here..</td>
        </tr>
        @endforelse
    </tbody>
</div>