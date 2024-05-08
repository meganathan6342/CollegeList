<?php

namespace App\Services;

use App\Repositories\StudentsRepository;
use Illuminate\Support\Facades\Validator;

class StudentsService
{
    protected $studentsRepository;

    public function __construct(StudentsRepository $studentsRepository)
    {
        $this->studentsRepository = $studentsRepository;
    }

    public function getAllStudents($perPage, $college_id)
    {
        return $this->studentsRepository->getAll($perPage, $college_id);
    }

    public function getStudentById($staff_id)
    {
        return $this->studentsRepository->getById($staff_id);
    }

    public function getCollegeById($college_id)
    {
        return $this->studentsRepository->collegeById($college_id);
    }

    public function getDeptsByCollegeId($college_id)
    {
        return $this->studentsRepository->deptsById($college_id);
    }

    public function storeStudent($studentData, $addressData)
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

        $studentValidator = Validator::make($studentData, [
            'student_name' => 'required|regex:/^[a-zA-Z\s]+$/|max:45',
            'student_dob' => 'required',
            'mobile_no' => 'required|regex:/^[6-9]\d{9}$/',
        ], [
            'student_name.required' => 'student name is required',
            'student_name.regex' => 'alphabets only allowed',
            'student_name.max' => 'student name is too long',
            'student_dob.required' => 'student dob is required',
            'mobile_no.required' => 'mobile nubmber is required',
            'mobile_no.regex' => 'please enter valid mobile number',
        ]);
        if ($studentValidator->fails()) {
            $errors = $studentValidator->errors()->toArray();
            return $errors;
        }

        $content = file_get_contents(storage_path('app/texts/generateValueForStudents.txt'));

        $student_id = ($studentData['dept_short_code'] . '_' . 'STD' . '_' . $content);
        $studentData['student_id'] = $student_id;

        $student = $this->studentsRepository->store($studentData, $addressData);

        if (!(is_array($student))) {
            $content++;
            file_put_contents(storage_path('app/texts/generateValueForStudents.txt'), $content);
        }
        return $student;
    }

    public function updateStudent($studentData, $addressData)
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

        $studentValidator = Validator::make($studentData, [
            'student_name' => 'required|regex:/^[a-zA-Z\s]+$/|max:45',
            'student_dob' => 'required',
            'mobile_no' => 'required|regex:/^[6-9]\d{9}$/',
        ], [
            'student_name.required' => 'student name is required',
            'student_name.regex' => 'alphabets only allowed',
            'student_name.max' => 'student name is too long',
            'student_dob.required' => 'student dob is required',
            'mobile_no.required' => 'mobile nubmber is required',
            'mobile_no.regex' => 'please enter valid mobile number',
        ]);
        if ($studentValidator->fails()) {
            $errors = $studentValidator->errors()->toArray();
            return $errors;
        }

        return $this->studentsRepository->update($studentData, $addressData);
    }

    public function deleteStudent($student_id)
    {
        $student = $this->studentsRepository->delete($student_id);
        if(!empty($student)) {
            $content = file_get_contents(storage_path('app/texts/generateValueForStudents.txt'));
            $content--;
            file_put_contents(storage_path('app/texts/generateValueForStudents.txt'), $content);
        }
        return $student;
    }

    public function searchStudent($value)
    {
        return $this->studentsRepository->getBySearch($value);
    }
}
