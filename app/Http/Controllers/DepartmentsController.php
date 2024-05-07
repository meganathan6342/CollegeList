<?php

namespace App\Http\Controllers;

use App\Services\DepartmentsService;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    protected $departmentsService;

    public function __construct(DepartmentsService $departmentsService)
    {
        $this->departmentsService = $departmentsService;
    }
    public function index(Request $request, $college_id)
    {
        $college = $this->departmentsService->getCollegeById($college_id);
        $perPage = $request->input('rowsPerPage', 5);
        $departments = $this->departmentsService->getAllDepts($perPage, $college_id);
        return view('Departments', compact('departments'), ["college" => $college]);
    }

    public function store(Request $request)
    {
        $college_id = $request->input('college_id');
        $dept_name = $request->input('dept_name');

        $data = array('college_id' => $college_id, 'dept_name' => $dept_name);
        $dept = $this->departmentsService->storeDept($data);

        if (is_array($dept)) {
            return redirect()->back()->withErrors($dept)->withInput();
        }
        return redirect()->back()->with('message', 'dept is stored successfully!');
    }

    public function edit(Request $request)
    {
        $dept_short_code = $request->input('data');
        $department = $this->departmentsService->getDeptById($dept_short_code);
        return view('DepartmentsForm', ['department' => $department]);
    }
    public function update(Request $request, $id)
    {
        $dept_name = $request->input('dept_name');
        $data = array('dept_short_code' => $id, 'dept_name' => $dept_name);
        $dept = $this->departmentsService->updateDept($data);

        if (is_array($dept)) {
            return redirect()->back()->withErrors($dept)->withInput();
        }
        return redirect()->back()->with('message', 'dept details are updated successfully!');
    }
    public function delete(Request $request)
    {
        $id = json_decode(urldecode($request->input('data')), true);
        $this->departmentsService->deleteDept($id);

        return redirect()->back()->with('success', 'deleted college details suceessfully!');
    }

    public function search(Request $request)
    {
        $value = $request->input('data');
        $departments = $this->departmentsService->searchDept($value);
        return view('SearchedDepartments', ["departments" => $departments]);
    }
}
