<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Form</title>
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}" />
    <style>
        #form{
            position: relative;
            left: 420px;
            top: 160px;
        }
        #form td{
            padding: 15px 5px;
        }
    </style>
</head>

<body>
    <div id="form">
        @if(isset($department))
        <h3>Department Update Form</h3>
        <form action="{{ route('editing.dept', $department->dept_short_code)}}" method="POST">
            @csrf
            @method('PUT')
            <table>
                <tbody>
                    <tr>
                        <td>Department Name : </td>
                        <td><input type="text" name="dept_name" value="{{ $department->dept_name }}" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;"><input type="submit" value="Update" class="submit"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        @else
        <h3>Department Form</h3>
        <form action="submit-dept" method="POST">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <td><input type="tel" name="college_id" value="{{ $id }}" style="visibility: hidden;" required></td>
                    </tr>
                    <tr>
                        <td>Department Name : </td>
                        <td><input type="text" name="dept_name" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;"><input type="submit" value="Submit" class="submit"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        @endif
        @if(session()->has('message'))
        <p style="color: green;">{{ session()->get('message') }}</p>
        @endif
    </div>
</body>

</html>