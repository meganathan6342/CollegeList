<div class="forms">
    <form action="{{ route('editing.dept', $department->dept_short_code)}}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tbody>
                <tr>
                    <td>Department Name : </td>
                    <td><input type="text" id="inp1" name="dept_name" value="{{ $department->dept_name }}" required></td>
                </tr>
                <tr>
                    <td><button class="submit" onclick="closeUpdatePopup()" class="submit">Close</button></td>
                    <td colspan="2" style="text-align: right;"><input type="submit" value="Update" class="submit"></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>