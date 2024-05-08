<?php

namespace App\Http\Controllers;

use App\Services\StaffsService;
use Illuminate\Http\Request;

class StaffsController extends Controller
{
    protected $staffsService;

    public function __construct(StaffsService $staffsService)
    {
        $this->staffsService = $staffsService;
    }
    public function index(Request $request, $college_id)
    {
        $college = $this->staffsService->getCollegeById($college_id);
        $departments = $this->staffsService->getDeptsByCollegeId($college_id);
        $perPage = $request->input('rowsPerPage', 5);
        $staffs = $this->staffsService->getAllStaffs($perPage, $college_id);
        return view('Staffs', ["college" => $college, "departments" => $departments, "staffs" => $staffs]);
    }
    public function store(Request $request)
    {
        $street_1 = $request->input('street_1');
        $street_2 = $request->input('street_2');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');

        $addressData = array('street_1' => $street_1, 'street_2' => $street_2, 'city' => $city, 'state' => $state, 'country' => $country);

        $college_id = $request->input('college_id');
        $staff_name = $request->input('staff_name');
        $staff_gender = $request->input('staff_gender');
        $staff_dob = $request->input('staff_dob');
        $mobile_no = $request->input('mobile_no');
        $dept_short_code = $request->input('dept_short_code');

        $staffData = array('college_id' => $college_id, 'staff_name' => $staff_name, 'staff_gender' => $staff_gender, 'staff_dob' => $staff_dob, 'mobile_no' => $mobile_no, 'dept_short_code' => $dept_short_code);

        $staff = $this->staffsService->storeStaff($staffData, $addressData);

        if (is_array($staff)) {
            return redirect()->back()->withErrors($staff)->withInput();
        }
        if (is_string($staff)) {
            return redirect()->back()->with('error', $staff);
        }

        return redirect()->back()->with('message', 'stored staff details..!');
    }
    public function edit(Request $request)
    {
        $staff_id = $request->input('data');
        $staff = $this->staffsService->getStaffById($staff_id);
        $departments = $this->staffsService->getDeptsByCollegeId($staff->college_id);
        return view('StaffsForm', ["staff" => $staff, "departments" => $departments]);
    }

    public function update(Request $request, $staff_id)
    {

        $address_id = $request->input('address_id');
        $street_1 = $request->input('street_1');
        $street_2 = $request->input('street_2');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');

        $addressData = array('address_id' => $address_id, 'street_1' => $street_1, 'street_2' => $street_2, 'city' => $city, 'state' => $state, 'country' => $country);

        $college_id = $request->input('college_id');
        $staff_name = $request->input('staff_name');
        $staff_gender = $request->input('staff_gender');
        $staff_dob = $request->input('staff_dob');
        $mobile_no = $request->input('mobile_no');
        $dept_short_code = $request->input('dept_short_code');

        $staffData = array('college_id' => $college_id, 'staff_id' => $staff_id, 'staff_name' => $staff_name, 'staff_gender' => $staff_gender, 'staff_dob' => $staff_dob, 'mobile_no' => $mobile_no, 'dept_short_code' => $dept_short_code);

        $staff = $this->staffsService->updateStaff($staffData, $addressData);

        if (is_array($staff)) {
            return redirect()->back()->withErrors($staff)->withInput();
        }
        if (is_string($staff)) {
            return redirect()->back()->with('error', $staff);
        }

        return redirect()->back()->with('message', 'updated staff details..!');
    }
    public function delete(Request $request)
    {
        $staff_id = json_decode(urldecode($request->input('data')), true);

        $staff = $this->staffsService->deleteStaff($staff_id);

        return redirect()->back()->with('message', 'deleted staff details..!');
    }
    public function search(Request $request)
    {
        $value = $request->input('data');
        $staffs = $this->staffsService->searchStaff($value);
        return view('SearchedStaffs', ["staffs" => $staffs]);
    }
}
