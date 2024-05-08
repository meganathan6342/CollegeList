<div class="forms">
    <button onclick="closeUpdatePopup()" class="close-btn">X</i></button>
    <form action="{{ route('update.student', $student->student_id)}}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tbody>
                <tr>
                    <td><input type="tel" class="inp" name="college_id" value="{{ $student->college_id }}" style="visibility: hidden;" required></td>
                </tr>
                <tr>
                    <td>Student Name : </td>
                    <td><input type="text" id="inp21" class="inp" name="student_name" value="{{ $student->student_name }}" required onkeyup="alphabetValidation(this.value, 0)"></td>
                </tr>
                <tr>
                    <td class="al-msgs">alphabets only allowed</td>
                </tr>
                <tr>
                    <td>Student Gender : </td>
                    <td><input type="radio" name="student_gender" value="M" required {{ $student->student_gender == 'M' ? 'checked' : '' }}> : Male <input type="radio" name="student_gender" value="F" {{ $student->student_gender == 'F' ? 'checked' : '' }}> : Female <input type="radio" name="student_gender" value="O" {{ $student->student_gender == 'O' ? 'checked' : '' }}> : Others</td>
                </tr>
                <tr>
                    <td>Student DOB : </td>
                    <td><input type="date" id="dob2" class="inp" name="student_dob" value="{{ $student->student_dob }}" required onblur="calculateAge(this)"><span style="margin-left: 8px;"></span></td>
                </tr>
                <tr>
                    <td class="dob-msgs">select valid age</td>
                </tr>
                <tr>
                    <td>Student Mobile no. : </td>
                    <td><input type="tel" id="mobile-no2" class="inp" name="mobile_no" value="{{ $student->mobile_no }}" required onchange="mobileNumberValidation(this)"></td>
                </tr>
                <tr>
                    <td class="mob-msgs">please enter valid mobile number</td>
                </tr>
                <input type="tel" name="address_id" value="{{ $student->addresses->address_id }}" style="visibility: hidden;" required>
                <tr>
                    <td>Street 1 : </td>
                    <td><input type="text" id="inp22" class="inp" name="street_1" value="{{ $student->addresses->street_1 }}" required onkeyup="streetValidation(this.value, 0)"></td>
                </tr>
                <tr>
                    <td class="st-msgs">alphabets only allowed</td>
                </tr>
                <tr>
                    <td>Street 2 : </td>
                    <td><input type="text" id="inp23" class="inp" name="street_2" value="{{ $student->addresses->street_2 }}" placeholder="Optional" onkeyup="streetValidation(this.value, 1)"></td>
                </tr>
                <tr>
                    <td class="st-msgs">alphabets only allowed</td>
                </tr>
                <tr>
                    <td>City : </td>
                    <td><input type="text" id="inp24" class="inp" name="city" value="{{ $student->addresses->city }}" required onkeyup="alphabetValidation(this.value, 1)"></td>
                </tr>
                <tr>
                    <td class="al-msgs">alphabets only allowed</td>
                </tr>
                <tr>
                    <td>State : </td>
                    <td><input type="text" id="inp25" class="inp" name="state" value="{{ $student->addresses->state }}" required onkeyup="alphabetValidation(this.value, 2)"></td>
                </tr>
                <tr>
                    <td class="al-msgs">alphabets only allowed</td>
                </tr>
                <tr>
                    <td>Country : </td>
                    <td><input type="text" id="inp26" class="inp" name="country" value="{{ $student->addresses->country }}" required onkeyup="alphabetValidation(this.value, 3)"></td>
                </tr>
                <tr>
                    <td class="al-msgs">alphabets only allowed</td>
                </tr>
                <tr>
                    <td>Student dept short code : </td>
                    <td>
                        <select name="dept_short_code">
                            <option value="{{$student->dept_short_code}}" style="background-color: rgb(200, 200, 200); border: 1px solid green;">{{ $student->departments->dept_name }}</option>
                            @foreach($departments as $department)
                            <option value="{{$department->dept_short_code}}">{{ $department->dept_name }}</option>
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