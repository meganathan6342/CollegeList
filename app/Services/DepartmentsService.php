<?php

namespace App\Services;

use App\Repositories\DepartmentsRepository;
use Illuminate\Support\Facades\Validator;

class DepartmentsService
{
    protected $departmentsRepository;

    public function __construct(DepartmentsRepository $departmentsRepository)
    {
        $this->departmentsRepository = $departmentsRepository;
    }

    public function getAllDepts($perPage, $college_id)
    {
        return $this->departmentsRepository->getAll($perPage, $college_id);
    }

    public function getDeptById($dept_short_code)
    {
        return $this->departmentsRepository->getById($dept_short_code);
    }

    public function getCollegeById($college_id)
    {
        return $this->departmentsRepository->collegeById($college_id);
    }

    public function storeDept($data)
    {
        $validator = Validator::make($data, [
            'dept_name' => 'required|regex:/^[a-zA-Z\s.]+$/|unique:departments|max:45',
        ], [
            'dept_name.required' => 'dept name is required',
            'dept_name.regex' => 'alphabets only allowed',
            'dept_name.unique' => 'dept is already presented',
            'dept_name.max' => 'dept name is too long',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return $errors;
        }

        $college_id = $data['college_id'];
        $college = $this->departmentsRepository->collegeById($college_id);
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

        $dept_name = $data['dept_name'];
        $dept_code = null;
        if (strpos($dept_name, '.') !== false) {
            if (strlen($dept_name) < 6) {
                $dept_code = strtoupper($dept_name);
            } else {
                $dwords = explode(" ", $dept_name);
                $word = $dwords[1];
                $dept_code = $word[0] . $word[1] . $word[2];
            }
        } else {
            $dwords = explode(" ", $dept_name);
            if (count($dwords) > 1) {
                foreach ($dwords as $word) {
                    $dept_code .= $word[0];
                }
            } else {
                $dept_code = $dept_name[0] . $dept_name[1] . $dept_name[2];
            }
        }

        $dept_code = strtoupper($dept_code);

        $dept_short_code = $clg_short_code . '_' . $dept_code;

        $deptData = array('dept_short_code' => $dept_short_code, 'dept_name' => $dept_name, 'college_id' => $college_id);

        return $this->departmentsRepository->store($deptData);
    }

    public function updateDept($data)
    {
        $validator = Validator::make($data, [
            'dept_name' => 'required|regex:/^[a-zA-Z\s.]+$/|unique:departments|max:45',
        ], [
            'dept_name.required' => 'dept name is required',
            'dept_name.regex' => 'alphabets only allowed',
            'dept_name.unique' => 'dept is already presented',
            'dept_name.max' => 'dept name is too long',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return $errors;
        }

        $deptData = array('dept_short_code' => $data['dept_short_code'], 'dept_name' => $data['dept_name']);

        return $this->departmentsRepository->update($deptData);
    }

    public function deleteDept($dept_short_code)
    {
        return $this->departmentsRepository->delete($dept_short_code);
    }

    public function searchDept($value)
    {
        return $this->departmentsRepository->getBySearch($value);
    }
}
