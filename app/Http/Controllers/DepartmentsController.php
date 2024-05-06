<?php

namespace App\Http\Controllers;

use App\Models\CollegesModel;
use App\Models\DepartmentsModel;
use App\Services\DepartmentsService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    protected $deptservice;

    public function __construct(DepartmentsService $deptservice)
    {
        $this->deptservice = $deptservice;
    }
    public function index($id)
    {
        $college = CollegesModel::find($id);
        $departments = DepartmentsModel::where('college_id', $id)->get();
        return view('Departments', ["college" => $college, "departments" => $departments]);
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'dept_name' => 'required|regex:/^[\pL\s\-]+$/u|unique:departments|max:15',
        ], [
            'dept_name.required' => 'dept name is required',
            'dept_name.regex' => 'alphabets only allowed',
            'dept_name.unique' => 'dept is already presented',
            'dept_name.max' => 'dept_name is too long',
        ]);

        $college_id = $request->input('college_id');
        $college = CollegesModel::find($college_id);
        $college_name = $college->college_name;
        $cwords = explode(" ", $college_name);
        $clg_short_code = null;
        if (count($cwords) > 1) {
            foreach ($cwords as $word) {
                $clg_short_code .= $word[0];
            }
        } else {
            $clg_short_code = $college_name[0] . $college_name[1] . $college_name[2];
        }
        $clg_short_code = strtoupper($clg_short_code);

        $dept_name = $request->input('dept_name');
        $dwords = explode(" ", $dept_name);
        $dept_code = null;
        echo count($dwords);
        if (count($dwords) > 1) {
            foreach ($dwords as $word) {
                $dept_code .= $word[0];
            }
        } else {
            $dept_code = $dept_name[0] . $dept_name[1] . $dept_name[2];
        }
        $dept_code = strtoupper($dept_code);

        $dept_short_code = $clg_short_code . '_' . $dept_code;

        $dept = ['dept_short_code' => $dept_short_code, 'dept_name' => $dept_name, 'college_id' => $college_id];

        $this->deptservice->createDept($dept);

        return redirect()->back()->with('message', 'dept is stored successfully..');
    }
    public function edit(Request $request)
    {
        $id = $request->input('data');
        $department = $this->deptservice->getDeptById($id);
        return view('DepartmentsForm', ["department" => $department]);
    }
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'dept_name' => 'required|regex:/^[\pL\s\-]+$/u|unique:departments|max:15',
        ], [
            'dept_name.required' => 'dept name is required',
            'dept_name.regex' => 'alphabets only allowed',
            'dept_name.unique' => 'dept is already presented',
            'dept_name.max' => 'dept_name is too long',
        ]);

        $dept_name = $request->input('dept_name');
        $words = explode("_", $request->input('dept_short_code'));
        $clg_short_code = $words[0];
        $dwords = explode(" ", $dept_name);
        $dept_code = null;
        echo count($dwords);
        if (count($dwords) > 1) {
            foreach ($dwords as $word) {
                $dept_code .= $word[0];
            }
        } else {
            $dept_code = $dept_name[0] . $dept_name[1] . $dept_name[2];
        }
        $dept_code = strtoupper($dept_code);

        $dept_short_code = $clg_short_code . '_' . $dept_code;
        $college_id = $request->input('college_id');

        $this->deptservice->updateDept($request->input('dept_short_code'), $dept_short_code, $dept_name);

        return redirect()->back()->with('message', 'dept is updated');
    }

    public function delete(Request $request)
    {
        $id = json_decode(urldecode($request->input('data')), true);
        $this->deptservice->deleteDept($id);

        return redirect()->back()->with('message', 'dept is deleted');
    }
}
