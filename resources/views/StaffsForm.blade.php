<div class="forms">
    <button onclick="closeUpdatePopup()" class="close-btn">X</button>
    <form action="{{ route('update.staff', $staff->staff_id)}}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tbody>
                <input type="tel" name="college_id" value="{{ $staff->college_id }}" style="visibility: hidden;" class="inp">
                <tr>
                    <td>Staff Name : </td>
                    <td><input type="text" name="staff_name" value="{{ $staff->staff_name }}" id="inp21" class="inp" required onkeyup="alphabetValidation(this.value, 0)"></td>
                </tr>
                <tr>
                    <td class="al-msgs">alphabets only allowed</td>
                </tr>
                <tr>
                    <td>Staff Gender : </td>
                    <td><input type="radio" name="staff_gender" value="M" required {{ $staff->staff_gender == 'M' ? 'checked' : '' }}> : Male <input type="radio" name="staff_gender" value="F" {{ $staff->staff_gender == 'F' ? 'checked' : '' }}> : Female <input type="radio" name="staff_gender" value="O" {{ $staff->staff_gender == 'O' ? 'checked' : '' }}> : Others</td>
                </tr>
                <tr>
                    <td>Staff DOB : </td>
                    <td><input type="date" name="staff_dob" value="{{ $staff->staff_dob }}" id="dob2" class="inp" required onblur="calculateAge(this)"><span style="margin-left: 8px;"></span></td>
                </tr>
                <tr>
                    <td class="dob-msgs">select valid age</td>
                </tr>
                <tr>
                    <td>Staff Mobile no. : </td>
                    <td><input type="tel" name="mobile_no" value="{{ $staff->mobile_no }}" id="mobile-no2" class="inp" required onchange="mobileNumberValidation(this)"></td>
                </tr>
                <tr>
                    <td class="mob-msgs">please enter valid mobile number</td>
                </tr>
                <input type="tel" name="address_id" value="{{ $staff->addresses->address_id }}" style="visibility: hidden;" class="inp" required>
                <tr>
                    <td>Street 1 : </td>
                    <td><input type="text" name="street_1" value="{{ $staff->addresses->street_1 }}" id="inp22" class="inp" required onkeyup="streetValidation(this.value, 0)"></td>
                </tr>
                <tr>
                    <td class="st-msgs">special chars not allowed</td>
                </tr>
                <tr>
                    <td>Street 2 : </td>
                    <td><input type="text" name="street_2" value="{{ $staff->addresses->street_2 }}" id="inp23" class="inp" placeholder="Optional" onkeyup="streetValidation(this.value, 1)"></td>
                </tr>
                <tr>
                    <td class="st-msgs">special chars not allowed</td>
                </tr>
                <tr>
                    <td>City : </td>
                    <td><input type="text" name="city" value="{{ $staff->addresses->city }}" id="inp24" class="inp" required onkeyup="alphabetValidation(this.value, 1)"></td>
                </tr>
                <tr>
                    <td class="al-msgs">alphabets only allowed</td>
                </tr>
                <tr>
                    <td>State : </td>
                    <td><input type="text" name="state" value="{{ $staff->addresses->state }}" id="inp25" class="inp" required onkeyup="alphabetValidation(this.value, 2)"></td>
                </tr>
                <tr>
                    <td class="al-msgs">alphabets only allowed</td>
                </tr>
                <tr>
                    <td>Country : </td>
                    <td><input type="text" name="country" value="{{ $staff->addresses->country }}" id="inp26" class="inp" required onkeyup="alphabetValidation(this.value, 3)"></td>
                </tr>
                <tr>
                    <td class="al-msgs">alphabets only allowed</td>
                </tr>
                <tr>
                    <td>Department Name : </td>
                    <td>
                        <select name="dept_short_code" value="{{ $staff->departments->dept_name }}" required>
                            @foreach($departments as $department)
                            <option value="{{ $department->dept_short_code }}">{{ $department->dept_name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right; padding-right: 20px;"><input type="submit" value="Update" class="submit"></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>