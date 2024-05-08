<?php

namespace App\Repositories;

use App\Models\CollegesModel;
use App\Models\DepartmentsModel;

class DepartmentsRepository
{
    public function getAll($perPage, $college_id)
    {
        return DepartmentsModel::where('college_id', $college_id)->paginate($perPage);
    }

    public function getById($dept_short_code)
    {
        return DepartmentsModel::find($dept_short_code);
    }

    public function collegeById($college_id)
    {
        return CollegesModel::find($college_id);
    }

    public function store($data)
    {
        try {
            $dept = new DepartmentsModel();
            $dept->dept_short_code = $data['dept_short_code'];
            $dept->dept_name = $data['dept_name'];
            $dept->college_id = $data['college_id'];
            $dept->save();

            return $dept;
        } catch (\Throwable $th) {
            return 'department is already presented.. :(';
        }
    }

    public function update($data)
    {
        try {
            $department = DepartmentsModel::find($data['dept_short_code']);
            $department->dept_name = $data['dept_name'];
            $department->save();

            return $department;
        } catch (\Throwable $th) {
            return 'something went wrong.. :(';
        }
    }

    public function delete($dept_short_code)
    {
        return DepartmentsModel::destroy($dept_short_code);
    }

    public function getBySearch($value)
    {
        return DepartmentsModel::where('dept_name', 'LIKE', '%' . $value . '%')->get();
    }
}
