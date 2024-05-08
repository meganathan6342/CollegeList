<?php

namespace App\Http\Controllers;

use App\Services\StudentsService;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    protected $studentsService;

    public function __construct(StudentsService $studentsService)
    {
        $this->studentsService = $studentsService;
    }
    public function index(Request $request, $college_id)
    {
        $college = $this->studentsService->getCollegeById($college_id);
        $departments = $this->studentsService->getDeptsByCollegeId($college_id);
        $perPage = $request->input('rowsPerPage', 5);
        $students = $this->studentsService->getAllStudents($perPage, $college_id);
        return view('Students', ["college" => $college, "departments" => $departments, "students" => $students]);
    }
    public function store(Request $request)
    {
        $street_1 = $request->input('street_1');
        $street_2 = $request->input('street_2');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');

        $addressData = array('street_1' => $street_1, 'street_2' => $street_2, 'city' => $city, 'state' => $state, 'country' => $country);

        $college_id = $request->input('college_id');
        $student_name = $request->input('student_name');
        $student_gender = $request->input('student_gender');
        $student_dob = $request->input('student_dob');
        $mobile_no = $request->input('mobile_no');
        $dept_short_code = $request->input('dept_short_code');

        $studentData = array('college_id' => $college_id, 'student_name' => $student_name, 'student_gender' => $student_gender, 'student_dob' => $student_dob, 'mobile_no' => $mobile_no, 'dept_short_code' => $dept_short_code);

        $student = $this->studentsService->storeStudent($studentData, $addressData);

        if (is_array($student)) {
            return redirect()->back()->withErrors($student)->withInput();
        }
        if (is_string($student)) {
            return redirect()->back()->with('error', $student);
        }

        return redirect()->back()->with('message', 'stored student details..!');
    }
    public function edit(Request $request)
    {
        $student_id = $request->input('data');
        $student = $this->studentsService->getStudentById($student_id);
        $departments = $this->studentsService->getDeptsByCollegeId($student->college_id);
        return view('StudentsForm', ["student" => $student, "departments" => $departments]);
    }

    public function update(Request $request, $student_id)
    {

        $address_id = $request->input('address_id');
        $street_1 = $request->input('street_1');
        $street_2 = $request->input('street_2');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');

        $addressData = array('address_id' => $address_id, 'street_1' => $street_1, 'street_2' => $street_2, 'city' => $city, 'state' => $state, 'country' => $country);

        $college_id = $request->input('college_id');
        $student_name = $request->input('student_name');
        $student_gender = $request->input('student_gender');
        $student_dob = $request->input('student_dob');
        $mobile_no = $request->input('mobile_no');
        $dept_short_code = $request->input('dept_short_code');

        $studentData = array('college_id' => $college_id, 'student_id' => $student_id, 'student_name' => $student_name, 'student_gender' => $student_gender, 'student_dob' => $student_dob, 'mobile_no' => $mobile_no, 'dept_short_code' => $dept_short_code);

        $student = $this->studentsService->updateStudent($studentData, $addressData);

        if (is_array($student)) {
            return redirect()->back()->withErrors($student)->withInput();
        }
        if (is_string($student)) {
            return redirect()->back()->with('error', $student);
        }

        return redirect()->back()->with('message', 'updated student details..!');
    }
    public function delete(Request $request)
    {
        $student_id = json_decode(urldecode($request->input('data')), true);

        $student = $this->studentsService->deleteStudent($student_id);

        return redirect()->back()->with('message', 'deleted student details..!');
    }
    public function search(Request $request)
    {
        $value = $request->input('data');
        $students = $this->studentsService->searchStudent($value);
        return view('SearchedStudents', ["students" => $students]);
    }
}
