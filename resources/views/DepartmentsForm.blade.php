<div class="forms">
    <button onclick="closeUpdatePopup()" class="close-btn" style="margin-bottom: 20px;">X</button>
    <form action="{{ route('update.dept', $department->dept_short_code)}}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tbody>
                <input type="text" name="college_id" value="{{ $department->colleges->college_id }}" style="visibility: hidden;">
                <tr>
                    <td>Department Name : </td>
                    <td><input type="text" id="inp21" name="dept_name" value="{{ $department->dept_name }}" required onkeyup="deptNameValidation(this.value)"></td>
                </tr>
                <tr>
                    <td class="dept-msg">alphabets only allowed</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;"><input type="submit" value="Update" class="submit"></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>