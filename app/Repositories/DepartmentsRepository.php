<?php

namespace App\Repositories;

use App\Models\DepartmentsModel;

class DepartmentsRepository
{
    protected $dept;

    public function __construct(DepartmentsModel $dept)
    {
        $this->dept = $dept;
    }
    public function getAll()
    {
        return $this->dept->all();
    }

    public function findById($dept_short_code)
    {
        return $this->dept->find($dept_short_code);
    }

    public function findByName($dept_name)
    {
        return DepartmentsModel::where('dept_name', $dept_name);
    }

    public function create(array $dept)
    {
        $dept = new DepartmentsModel();
        $dept->dept_short_code = $dept['dept_short_code'];
        $dept->dept_name = $dept['dept_name'];
        $dept->college_id = $dept['college_id'];
        $dept->save();

        return $dept;
    }

    public function update($dept_short_code, $id, $dept_name)
    {
        $dept = DepartmentsModel::find($dept_short_code);
        // $dept->dept_short_code = $id;
        $dept->dept_name = $dept_name;
        $dept->save();

        return $dept;
    }

    public function delete($dept_short_code)
    {
        return DepartmentsModel::destroy($dept_short_code);
    }
}