<div class="forms">
    <button onclick="closeUpdatePopup()" class="close-btn">X</button>
    <form action="{{ route('editing.college', $college->college_id)}}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tbody>
                <tr>
                    <td>College Name : </td>
                    <td><input type="text" id="inp21" name="college_name" value="{{ $college->college_name }}" required></td>
                </tr>
                <tr><td id="msg21">alphabets only allowed</td></tr>
                <input type="tel" name="address_id" value="{{ $college->addresses->address_id }}" style="visibility: hidden;" required>
                <tr>
                    <td>Street 1 : </td>
                    <td><input type="text" id="inp22" name="street_1" value="{{ $college->addresses->street_1 }}" required></td>
                </tr>
                <tr><td id="msg22">special char not allowed</td></tr>
                <tr>
                    <td>Street 2 : </td>
                    <td><input type="text" id="inp23" name="street_2" value="{{ $college->addresses->street_2 }}" required></td>
                </tr>
                <tr><td id="msg23">special char not allowed</td></tr>
                <tr>
                    <td>City : </td>
                    <td><input type="text" id="inp24" name="city" value="{{ $college->addresses->city }}" required></td>
                </tr>
                <tr><td id="msg24">alphabets only allowed</td></tr>
                <tr>
                    <td>State : </td>
                    <td><input type="text" id="inp25" name="state" value="{{ $college->addresses->state }}" required></td>
                </tr>
                <tr><td id="msg25">alphabets only allowed</td></tr>
                <tr>
                    <td>Country : </td>
                    <td><input type="text" id="inp26" name="country" value="{{ $college->addresses->country }}" required></td>
                </tr>
                <tr><td id="msg26">alphabets only allowed</td></tr>
                <tr>
                    <td colspan="2" style="text-align: right;"><input type="submit" value="Update" class="submit"></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>