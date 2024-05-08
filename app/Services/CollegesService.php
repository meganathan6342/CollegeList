<?php

namespace App\Services;

use App\Repositories\CollegesRepository;
use Illuminate\Support\Facades\Validator;

class CollegesService
{
    protected $collegesRepository;

    public function __construct(CollegesRepository $collegesRepository)
    {
        $this->collegesRepository = $collegesRepository;
    }

    public function getAllColleges($perPage)
    {
        return $this->collegesRepository->getAll($perPage);
    }

    public function getCollegeById($college_id)
    {
        return $this->collegesRepository->getById($college_id);
    }
    public function storeCollege($collegeData, $addressData)
    {
        $collegeValidator = Validator::make($collegeData, [
            'college_name' => 'required|regex:/^[a-zA-Z\s]+$/|unique:colleges|max:45',
        ], [
            'college_name.required' => 'college name is required',
            'college_name.regex' => 'alphabets only allowed',
            'college_name.unique' => 'college is already presented',
            'college_name.max' => 'college name is too long',
        ]);
        if ($collegeValidator->fails()) {
            $errors = $collegeValidator->errors()->toArray();
            return $errors;
        }

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

        return $this->collegesRepository->store($collegeData, $addressData);
    }

    public function updateCollege($collegeData, $addressData)
    {
        $collegeValidator = Validator::make($collegeData, [
            'college_name' => 'required|regex:/^[a-zA-Z\s]+$/|max:45',
        ], [
            'college_name.required' => 'college name is required',
            'college_name.regex' => 'alphabets only allowed',
            'college_name.max' => 'college name is too long',
        ]);
        if ($collegeValidator->fails()) {
            $errors = $collegeValidator->errors()->toArray();
            return $errors;
        }

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

        return $this->collegesRepository->update($collegeData, $addressData);
    }

    public function deleteCollege($college_id)
    {
        return $this->collegesRepository->delete($college_id);
    }

    public function searchCollege($value)
    {
        return $this->collegesRepository->getBySearch($value);
    }
}
