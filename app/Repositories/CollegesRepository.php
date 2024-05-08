<?php

namespace App\Repositories;

use App\Models\AddressesModel;
use App\Models\CollegesModel;

class CollegesRepository
{
    public function getAll($perPage)
    {
        return CollegesModel::paginate($perPage);
    }

    public function getById($college_id)
    {
        return CollegesModel::find($college_id);
    }

    public function store($collegeData, $addressData)
    {
        try {
            $address = new AddressesModel();
            $address->street_1 = $addressData['street_1'];
            $address->street_2 = $addressData['street_2'];
            $address->city = $addressData['city'];
            $address->state = $addressData['state'];
            $address->country = $addressData['country'];
            $address->save();

            $college = new CollegesModel();
            $college->college_name = $collegeData['college_name'];
            $college->address_id = AddressesModel::latest()->value('address_id');
            $college->save();

            return $college;
        } catch (\Throwable $th) {
            return 'college is already presented.. :(';
        }
    }

    public function update($collegeData, $addressData)
    {
        try {
            $address = AddressesModel::find($addressData['address_id']);
            $address->street_1 = $addressData['street_1'];
            $address->street_2 = $addressData['street_2'];
            $address->city = $addressData['city'];
            $address->state = $addressData['state'];
            $address->country = $addressData['country'];
            $address->save();

            $college = CollegesModel::find($collegeData['college_id']);
            $college->college_name = $collegeData['college_name'];
            $college->save();

            return $college;
        } catch (\Throwable $th) {
            return 'something went wrong.. :(';
        }
    }

    public function delete($college_id)
    {
        return CollegesModel::destroy($college_id);
    }

    public function getBySearch($value)
    {
        return CollegesModel::where('college_name', 'LIKE', '%' . $value . '%')->get();
    }
}
