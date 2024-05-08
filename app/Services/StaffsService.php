<?php

namespace App\Services;

use App\Repositories\StaffsRepository;
use Illuminate\Support\Facades\Validator;

class StaffsService
{
    protected $staffsRepository;

    public function __construct(StaffsRepository $staffsRepository)
    {
        $this->staffsRepository = $staffsRepository;
    }

    public function getAllStaffs($perPage, $college_id)
    {
        return $this->staffsRepository->getAll($perPage, $college_id);
    }

    public function getStaffById($staff_id)
    {
        return $this->staffsRepository->getById($staff_id);
    }

    public function getCollegeById($college_id)
    {
        return $this->staffsRepository->collegeById($college_id);
    }

    public function getDeptsByCollegeId($college_id)
    {
        return $this->staffsRepository->deptsById($college_id);
    }

    public function storeStaff($staffData, $addressData)
    {
        $addressValidator = Validator::make($addressData, [
            'street_1' => 'required|regex:/^[a-zA-Z0-9\s]*$/|max:45',
            'street_2' => 'nullable|regex:/^[a-zA-Z0-9\s]*$/|max:45',
            'city' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'state' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'country' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
        ], [
            'street_1.required' => 'street_1 is required',
            'city.required' => 'city is required',
            'state.required' => 'state is required',
            'country.required' => 'country is required',
            'street_1.regex' => 'special chars not allowed',
            'street_2.regex' => 'special chars not allowed',
            'city.regex' => 'alphabets only allowed',
            'state.regex' => 'alphabets only allowed',
            'country.regex' => 'alphabets only allowed',
            'street_1.max' => 'street 1 is too long',
            'street_2.max' => 'street 2 is too long',
            'city.max' => 'city name is too long',
            'state.max' => 'state name is too long',
            'country.max' => 'country name is too long',
        ]);
        if ($addressValidator->fails()) {
            $errors = $addressValidator->errors()->toArray();
            return $errors;
        }

        $staffValidator = Validator::make($staffData, [
            'staff_name' => 'required|regex:/^[a-zA-Z\s]+$/|max:45',
            'staff_dob' => 'required',
            'mobile_no' => 'required|regex:/^[6-9]\d{9}$/',
        ], [
            'staff_name.required' => 'staff name is required',
            'staff_name.regex' => 'alphabets only allowed',
            'staff_name.max' => 'staff name is too long',
            'staff_dob.required' => 'staff dob is required',
            'mobile_no.required' => 'mobile nubmber is required',
            'mobile_no.regex' => 'please enter valid mobile number',
        ]);
        if ($staffValidator->fails()) {
            $errors = $staffValidator->errors()->toArray();
            return $errors;
        }

        $content = file_get_contents(storage_path('app/texts/generateValueForStaffs.txt'));

        $staff_id = ($staffData['dept_short_code'] . '_' . 'STAFF' . '_' . $content);
        $staffData['staff_id'] = $staff_id;

        $staff = $this->staffsRepository->store($staffData, $addressData);

        if (!(is_array($staff))) {
            $content++;
            file_put_contents(storage_path('app/texts/generateValueForStaffs.txt'), $content);
        }
        return $staff;
    }

    public function updateStaff($staffData, $addressData)
    {
        $addressValidator = Validator::make($addressData, [
            'street_1' => 'required|regex:/^[a-zA-Z0-9\s]*$/|max:45',
            'street_2' => 'nullable|regex:/^[a-zA-Z0-9\s]*$/|max:45',
            'city' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'state' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'country' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
        ], [
            'street_1.required' => 'street_1 is required',
            'city.required' => 'city is required',
            'state.required' => 'state is required',
            'country.required' => 'country is required',
            'street_1.regex' => 'special chars not allowed',
            'street_2.regex' => 'special chars not allowed',
            'city.regex' => 'alphabets only allowed',
            'state.regex' => 'alphabets only allowed',
            'country.regex' => 'alphabets only allowed',
            'street_1.max' => 'street 1 is too long',
            'street_2.max' => 'street 2 is too long',
            'city.max' => 'city name is too long',
            'state.max' => 'state name is too long',
            'country.max' => 'country name is too long',
        ]);
        if ($addressValidator->fails()) {
            $errors = $addressValidator->errors()->toArray();
            return $errors;
        }

        $staffValidator = Validator::make($staffData, [
            'staff_name' => 'required|regex:/^[a-zA-Z\s]+$/|max:45',
            'staff_dob' => 'required',
            'mobile_no' => 'required|regex:/^[6-9]\d{9}$/',
        ], [
            'staff_name.required' => 'staff name is required',
            'staff_name.regex' => 'alphabets only allowed',
            'staff_name.max' => 'staff name is too long',
            'staff_dob.required' => 'staff dob is required',
            'mobile_no.required' => 'mobile nubmber is required',
            'mobile_no.regex' => 'please enter valid mobile number',
        ]);
        if ($staffValidator->fails()) {
            $errors = $staffValidator->errors()->toArray();
            return $errors;
        }

        return $this->staffsRepository->update($staffData, $addressData);
    }

    public function deleteStaff($staff_id)
    {
        $staff = $this->staffsRepository->delete($staff_id);
        if(!empty($staff)) {
            $content = file_get_contents(storage_path('app/texts/generateValueForStaffs.txt'));
            $content--;
            file_put_contents(storage_path('app/texts/generateValueForStaffs.txt'), $content);
        }
        return $staff;
    }

    public function searchStaff($value)
    {
        return $this->staffsRepository->getBySearch($value);
    }
}
