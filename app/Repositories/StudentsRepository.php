<?php

namespace App\Repositories;

use App\Models\AddressesModel;
use App\Models\CollegesModel;
use App\Models\DepartmentsModel;
use App\Models\StudentsModel;

class StudentsRepository
{
    public function getAll($perPage, $college_id)
    {
        return StudentsModel::where('college_id', $college_id)->paginate($perPage);
    }

    public function getById($student_id)
    {
        return StudentsModel::find($student_id);
    }

    public function collegeById($college_id)
    {
        return CollegesModel::find($college_id);
    }

    public function deptsById($college_id)
    {
        return DepartmentsModel::where('college_id', $college_id)->get();
    }

    public function store($studentData, $addressData)
    {
        try {
            $address = new AddressesModel();
            $address->street_1 = $addressData['street_1'];
            $address->street_2 = $addressData['street_2'];
            $address->city = $addressData['city'];
            $address->state = $addressData['state'];
            $address->country = $addressData['country'];
            $address->save();

            $student = new StudentsModel();
            $student->student_id = $studentData['student_id'];
            $student->student_name = $studentData['student_name'];
            $student->student_gender = $studentData['student_gender'];
            $student->student_dob = $studentData['student_dob'];
            $student->mobile_no = $studentData['mobile_no'];
            $student->address_id = AddressesModel::latest()->value('address_id');
            $student->college_id = $studentData['college_id'];
            $student->dept_short_code = $studentData['dept_short_code'];
            $student->save();

            return $student;
        } catch (\Throwable $th) {
            return 'student detail is already presented.. :(';
        }
    }

    public function update($studentData, $addressData)
    {
        try {
            $address = AddressesModel::find($addressData['address_id']);
            $address->street_1 = $addressData['street_1'];
            $address->street_2 = $addressData['street_2'];
            $address->city = $addressData['city'];
            $address->state = $addressData['state'];
            $address->country = $addressData['country'];
            $address->save();

            $student = StudentsModel::find($studentData['student_id']);
            $student->student_name = $studentData['student_name'];
            $student->student_gender = $studentData['student_gender'];
            $student->student_dob = $studentData['student_dob'];
            $student->mobile_no = $studentData['mobile_no'];
            $student->dept_short_code = $studentData['dept_short_code'];
            $student->save();

            return $student;
        } catch (\Throwable $th) {
            return 'something went wrong.. :(';
        }
    }

    public function delete($student_id)
    {
        return StudentsModel::destroy($student_id);
    }

    public function getBySearch($value)
    {
        return StudentsModel::where('student_name', 'LIKE', '%' . $value . '%')->get();
    }
}
