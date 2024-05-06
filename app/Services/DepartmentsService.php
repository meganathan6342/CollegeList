<?php

namespace App\Services;

use App\Models\DepartmentsModel;
use App\Repositories\DepartmentsRepository;

class DepartmentsService 
{
    protected $deptRepository;

    public function __construct(DepartmentsRepository $deptRepository)
    {
        $this->deptRepository = $deptRepository;
    }

    public function getAllDepts()
    {
        return $this->deptRepository->getAll();
    }

    public function getDeptById($dept_short_code)
    {
        return $this->deptRepository->findById($dept_short_code);
    }

    public function getDeptByName($dept_name)
    {
        return $this->deptRepository->findByName($dept_name);
    }

    public function createDept(array $dept)
    {
        return $this->deptRepository->create($dept);
    }

    public function updateDept($dept_short_code, $id, $dept_name)
    {
        //return $this->deptRepository->update($dept_short_code, $id, $dept_name);

        $dept = DepartmentsModel::find($dept_short_code);
        // $dept->dept_short_code = $id;
        $dept->dept_name = $dept_name;
        $dept->save();

        return $dept;
    }

    public function deleteDept($dept_short_code)
    {
        return $this->deptRepository->delete($dept_short_code);
    }
}