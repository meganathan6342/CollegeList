<?php

namespace App\Repositories;

use App\Models\AddressesModel;
use App\Models\CollegesModel;
use App\Models\DepartmentsModel;
use App\Models\StaffsModel;

class StaffsRepository
{
    public function getAll($perPage, $college_id)
    {
        return StaffsModel::where('college_id', $college_id)->paginate($perPage);
    }

    public function getById($staff_id)
    {
        return StaffsModel::find($staff_id);
    }

    public function collegeById($college_id)
    {
        return CollegesModel::find($college_id);
    }

    public function deptsById($college_id)
    {
        return DepartmentsModel::where('college_id', $college_id)->get();
    }

    public function store($staffData, $addressData)
    {
        try {
            $address = new AddressesModel();
            $address->street_1 = $addressData['street_1'];
            $address->street_2 = $addressData['street_2'];
            $address->city = $addressData['city'];
            $address->state = $addressData['state'];
            $address->country = $addressData['country'];
            $address->save();

            $staff = new StaffsModel();
            $staff->staff_id = $staffData['staff_id'];
            $staff->staff_name = $staffData['staff_name'];
            $staff->staff_gender = $staffData['staff_gender'];
            $staff->staff_dob = $staffData['staff_dob'];
            $staff->mobile_no = $staffData['mobile_no'];
            $staff->address_id = AddressesModel::latest()->value('address_id');
            $staff->college_id = $staffData['college_id'];
            $staff->dept_short_code = $staffData['dept_short_code'];
            $staff->save();

            return $staff;
        } catch (\Throwable $th) {
            return 'staff detail is already presented.. :(';
        }
    }

    public function update($staffData, $addressData)
    {
        try {
            $address = AddressesModel::find($addressData['address_id']);
            $address->street_1 = $addressData['street_1'];
            $address->street_2 = $addressData['street_2'];
            $address->city = $addressData['city'];
            $address->state = $addressData['state'];
            $address->country = $addressData['country'];
            $address->save();

            $staff = StaffsModel::find($staffData['staff_id']);
            $staff->staff_name = $staffData['staff_name'];
            $staff->staff_gender = $staffData['staff_gender'];
            $staff->staff_dob = $staffData['staff_dob'];
            $staff->mobile_no = $staffData['mobile_no'];
            $staff->dept_short_code = $staffData['dept_short_code'];
            $staff->save();

            return $staff;
        } catch (\Throwable $th) {
            return 'something went wrong.. :(';
        }
    }

    public function delete($staff_id)
    {
        return StaffsModel::destroy($staff_id);
    }

    public function getBySearch($value)
    {
        return StaffsModel::where('staff_name', 'LIKE', '%' . $value . '%')->get();
    }
}
