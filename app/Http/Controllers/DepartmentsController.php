<?php

namespace App\Http\Controllers;

use App\Models\CollegesModel;
use App\Models\DepartmentsModel;
use App\Models\StaffsModel;
use App\Models\StudentsModel;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function deptForm($id)
    {
        return view('DepartmentsForm', ["id" => $id]);
    }
    public function index($id)
    {
        $college = CollegesModel::find($id);
        $departments = DepartmentsModel::where('college_id', $id)->get();
        return view('Departments', ["college" => $college, "departments" => $departments]);
    }
    public function store(Request $request)
    {
        $cid = $request->input('college_id');
        $dept_name = $request->input('dept_name');
        $exist = DepartmentsModel::where('college_id', $cid)->where('dept_name', $dept_name)->exists();
        if (!$exist) {

            $uniqueKey = DepartmentsModel::generateUniqueKey();

            $dept = new DepartmentsModel();
            $dept->dept_short_code = $uniqueKey;
            $cid = $request->input('college_id');
            $dept->dept_name = $request->input('dept_name');
            $dept->dept_id = $cid . (string)($uniqueKey);
            $dept->college_id = $cid;
            $dept->save();
            return redirect()->back()->with('message', 'dept stored succussfully!');
        } else {
            return redirect()->back()->with('message', 'dept is already presented!');
        }
    }

    public function updateDeptForm(Request $request)
    {
        $id = json_decode(urldecode($request->input('data')), true);
        $department = DepartmentsModel::find($id);
        return view('DepartmentsForm', ['department' => $department]);
    }
    public function updateDepartment(Request $request, $id)
    {

        $department = DepartmentsModel::find($id);
        $department->dept_name = $request->input('dept_name');
        $department->save();

        return redirect()->route('home.colleges')->with('success', 'updated department details successfully!');
    }
    public function deleteDepartments(Request $request)
    {
        $id = json_decode(urldecode($request->input('data')), true);

        $students = StudentsModel::where('dept_short_code', $id)->get();
        foreach ($students as $student) {
            $student->delete();
        }
        $staffs = StaffsModel::where('dept_short_code', $id)->get();
        foreach ($staffs as $staff) {
            $staff->delete();
        }
        $department = DepartmentsModel::find($id);
        $department->delete();
        
        return redirect()->back()->with('success', 'deleted college details suceessfully!');
    }
}
