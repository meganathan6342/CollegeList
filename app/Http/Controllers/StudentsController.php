<?php

namespace App\Http\Controllers;

use App\Models\AddressesModel;
use App\Models\CollegesModel;
use App\Models\DepartmentsModel;
use App\Models\StudentsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    public function studentsForm($id)
    {
        $departments = DepartmentsModel::where('college_id', $id)->get();
        return view('StudentsForm', ["id" => $id, "departments" => $departments]);
    }
    public function index($id)
    {
        $college = CollegesModel::find($id);
        $students = StudentsModel::where('college_id', $id)->get();
        return view('Students', ["college" => $college, "students" => $students]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'regex:/^[\pL\s\-]+$/u',
            'mobile_no' => 'regex:/^[6-9][0-9]{9}$/',
        ], [
            'student_name.regex' => 'alphabets only allowed for student name',
            'mobile_no.required' => 'please enter a valid mobile number',
        ]);

        try {
            $cid = $request->input('college_id');

            $address = new AddressesModel();
            $address->street_1 = $request->input('street_1');
            $address->street_2 = $request->input('street_2');
            $address->city = $request->input('city');
            $address->state = $request->input('state');
            $address->country = $request->input('country');
            $address->save();

            $content = file_get_contents(storage_path('app/texts/generateValueForStudents.txt'));

            $student = new StudentsModel();
            $student->student_id = $cid . ($request->input('dept_short_code') . $content);
            $student->student_name = $request->input('student_name');
            $student->student_gender = $request->input('student_gender');
            $student->student_dob = $request->input('student_dob');
            $student->mobile_no = $request->input('mobile_no');
            $student->address_id = AddressesModel::latest()->value('address_id');
            $student->dept_short_code = $request->input('dept_short_code');
            $student->college_id = $cid;
            $student->save();

            $content++;
            file_put_contents(storage_path('app/texts/generateValueForStudents.txt'), $content);

            return redirect()->route('home.colleges')->with('message', 'stored student details successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'enter valid dept_short_code or check departments!');
        }
    }
    public function updateStudent(Request $request, $id)
    {
        $request->validate([
            'student_name' => 'regex:/^[\pL\s\-]+$/u',
            'mobile_no' => 'regex:/^[6-9][0-9]{9}$/',
        ], [
            'student_name.regex' => 'alphabets only allowed for student name',
            'mobile_no.required' => 'please enter a valid mobile number',
        ]);


        $address_id = $request->input('address_id');
        $address = AddressesModel::find($address_id);
        $address->street_1 = $request->input('street_1');
        $address->street_2 = $request->input('street_2');
        $address->city = $request->input('city');
        $address->state = $request->input('state');
        $address->country = $request->input('country');
        $address->save();

        $student = StudentsModel::find($id);
        $student->student_name = $request->input('student_name');
        $student->student_gender = $request->input('student_gender');
        $student->student_dob = $request->input('student_dob');
        $student->mobile_no = $request->input('mobile_no');
        $student->address_id = $address_id;
        $student->college_id = $request->input('college_id');
        $student->dept_short_code = $request->input('dept_short_code');
        $student->save();

        return redirect()->route('home.colleges')->with('success', 'updated student details successfully!');
    }
    public function deleteStudents(Request $request)
    {
        $decodedata = json_decode(urldecode($request->input('data')), true);
        foreach ($decodedata as $id) {
            $address_id = DB::select('select address_id from students where college_id = ?', [$id]);
            $aid = $address_id[0]->address_id;
            $address = AddressesModel::find($aid);
            if (!empty($address)) {
                $address->delete();
            }
            $student = StudentsModel::find($id);
            $student->delete();
        }
        return redirect()->back()->with('success', 'deleted student details suceessfully!');
    }
    public function updateStdForm(Request $request)
    {
        $id = json_decode(urldecode($request->input('data')), true);
        $student = StudentsModel::find($id);
        $departments = DepartmentsModel::where('college_id', $student->college_id)->get();
        return view('StudentsForm', ['student' => $student, "departments" => $departments]);
    }
}
