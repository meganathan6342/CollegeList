<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Form</title>
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}" />
    <style>
        #form{
            position: relative;
            left: 450px;
            top: 140px;
        }
    </style>
</head>

<body>
    <div id="form">
        @if(isset($college))
        <h3>College Update Form</h3>
        <form action="{{ route('editing.college', $college->college_id)}}" method="POST">
            @csrf
            @method('PUT')
            <table>
                <tbody>
                    <tr>
                        <td>College Name : </td>
                        <td><input type="text" name="college_name" value="{{ $college->college_name }}" required></td>
                    </tr>
                    <input type="tel" name="address_id" value="{{ $college->addresses->address_id }}" style="visibility: hidden;" required>
                    <tr>
                        <td>Street 1 : </td>
                        <td><input type="text" name="street_1" value="{{ $college->addresses->street_1 }}" required></td>
                    </tr>
                    <tr>
                        <td>Street 2 : </td>
                        <td><input type="text" name="street_2" value="{{ $college->addresses->street_2 }}" required></td>
                    </tr>
                    <tr>
                        <td>City : </td>
                        <td><input type="text" name="city" value="{{ $college->addresses->city }}" required></td>
                    </tr>
                    <tr>
                        <td>State : </td>
                        <td><input type="text" name="state" value="{{ $college->addresses->state }}" required></td>
                    </tr>
                    <tr>
                        <td>Country : </td>
                        <td><input type="text" name="country" value="{{ $college->addresses->country }}" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;"><input type="submit" value="Update" class="submit"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        @else
        <h3>College Form</h3>
        <form action="submit-college" method="POST">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <td>College Name : </td>
                        <td><input type="text" id="inp1" class="inp" name="college_name" required></td>
                    </tr>
                    <tr>
                        <td>Street 1 : </td>
                        <td><input type="text" id="inp2" class="inp" name="street_1" required></td>
                    </tr>
                    <tr>
                        <td>Street 2 : </td>
                        <td><input type="text" id="inp3" class="inp" name="street_2" required></td>
                    </tr>
                    <tr>
                        <td>City : </td>
                        <td><input type="text" id="inp4" class="inp" name="city" required></td>
                    </tr>
                    <tr>
                        <td>State : </td>
                        <td><input type="text" id="inp5" class="inp" name="state" required></td>
                    </tr>
                    <tr>
                        <td>Country : </td>
                        <td><input type="text" id="inp6" class="inp" name="country" required></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;" colspan="2"><input type="submit" value="Submit" id="inp7" class="submit"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        @endif
    </div>
</body>

</html>