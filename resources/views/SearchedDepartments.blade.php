<div>
    <tbody id="searchedData">
        <?php $a = 1; ?>
        @forelse($departments as $department)
        <tr>
            <td><?php echo $a++ . '.'; ?></td>
            <td style="width: 200px;">{{ $department->dept_name }}</td>
            <td>{{ $department->dept_short_code }}</td>
            <td style="width: 200px;">{{ $department->colleges->college_name }}</td>
            <td>
                <span title="edit" style="color: green;margin-left: 20px;" id="edit" onclick="editForm('<?php echo $department->dept_short_code ?>'); addUpdatePopup();"><i class="fa-solid fa-pen-to-square"></i></span>
                <span title="delete" style="color: red;margin-left: 10px;" id="delete" onclick="deleteDept('<?php echo $department->dept_short_code ?>')"><i class="fa-solid fa-trash"></i></span>
            </td>
        </tr>
        @empty
        <tr style="background-color: white;">
            <td colspan="5" style="border-style: none; color: red;">No matched results are here..</td>
        </tr>
        @endforelse
    </tbody>
</div>