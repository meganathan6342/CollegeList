<?php

namespace App\Http\Controllers;

use App\Models\CollegesModel;
use App\Models\DepartmentsModel;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function index($id)
    {
        $college = CollegesModel::find($id);
        $departments = DepartmentsModel::where('college_id', $id)->get();
        $editing = session()->has('editing_dept');
        return view('Departments', ["college" => $college, "departments" => $departments, "editing" => $editing]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'dept_name' => 'required|regex:/^[\pL\s\-]+$/u|unique:departments|max:15',
        ], [
            'dept_name.required' => 'dept name is required',
            'dept_name.regex' => 'alphabets only allowed',
            'dept_name.unique' => 'dept is already presented',
            'dept_name.max' => 'dept_name is too long',
        ]);

        $cid = $request->input('college_id');
        $dept_name = $request->input('dept_name');
        $exist = DepartmentsModel::where('college_id', $cid)->where('dept_name', $dept_name)->exists();
        if (!$exist) {

            $college = CollegesModel::find($request->input('college_id'));
            $college_name = $college->college_name;
            $cwords = explode(" ", $college_name);
            $clg_short_code = null;
            if(count($cwords) > 1) {
                foreach($cwords as $word) {
                    $clg_short_code .= $word[0];
                }
            }
            else {
                $clg_short_code = $college_name[0] . $college_name[1] . $college_name[2];
            }
            $clg_short_code = strtoupper($clg_short_code);

            $dept_name = $request->input('dept_name');
            $dwords = explode(" ", $dept_name);
            $dept_code = null;
            echo count($dwords);
            if(count($dwords) > 1) {
                foreach($dwords as $word) {
                    $dept_code .= $word[0];
                }
            }
            else {
                $dept_code = $dept_name[0] . $dept_name[1] . $dept_name[2];
            }
            $dept_code = strtoupper($dept_code);

            $dept_short_code = $clg_short_code . '_' . $dept_code;

            $dept = new DepartmentsModel();
            $dept->dept_short_code = $dept_short_code;
            $cid = $request->input('college_id');
            $dept->dept_name = $request->input('dept_name');
            $dept->college_id = $cid;
            $dept->save();
            return redirect()->back()->with('message', 'dept stored succussfully!');
        } else {
            return redirect()->back()->with('message', 'dept is already presented!');
        }
    }

    public function updateDeptForm(Request $request)
    {
        $id = $request->input('data');
        $department = DepartmentsModel::find($id);
        return view('DepartmentsForm', ['department' => $department]);
    }
    public function updateDepartment(Request $request, $id)
    {

        $department = DepartmentsModel::find($id);
        $department->dept_name = $request->input('dept_name');
        $department->save();

        return redirect()->back()->with('success', 'updated department details successfully!');
    }
    public function deleteDepartments(Request $request)
    {
        $id = json_decode(urldecode($request->input('data')), true);

        $department = DepartmentsModel::find($id);
        if (!empty($department)) {
            $department->delete();
        }

        return redirect()->back()->with('success', 'deleted college details suceessfully!');
    }
}
