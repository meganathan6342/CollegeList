<?php

namespace App\Http\Controllers;

use App\Models\AddressesModel;
use App\Models\CollegesModel;
use App\Models\DepartmentsModel;
use App\Models\StaffsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffsController extends Controller
{
    public function staffsForm($id)
    {
        $departments = DepartmentsModel::where('college_id', $id)->get();
        return view('StaffsForm', ["id" => $id, 'departments' => $departments]);
    }
    public function index($id)
    {
        $college = CollegesModel::find($id);
        $staffs = StaffsModel::where('college_id', $id)->get();
        return view('Staffs', ["college" => $college, "staffs" => $staffs]);
    }
    public function store(Request $request)
    {
        try {
            $cid = $request->input('college_id');

            $address = new AddressesModel();
            $address->street_1 = $request->input('street_1');
            $address->street_2 = $request->input('street_2');
            $address->city = $request->input('city');
            $address->state = $request->input('state');
            $address->country = $request->input('country');
            $address->save();

            $content = file_get_contents(storage_path('app/texts/generateValueForStaffs.txt'));

            $staff = new StaffsModel();
            $staff->staff_id = $cid . ($request->input('dept_short_code') . $content);
            $staff->staff_name = $request->input('staff_name');
            $staff->staff_gender = $request->input('staff_gender');
            $staff->staff_dob = $request->input('staff_dob');
            $staff->mobile_no = $request->input('mobile_no');
            $staff->address_id = AddressesModel::latest()->value('address_id');
            $staff->dept_short_code = $request->input('dept_short_code');
            $staff->college_id = $cid;
            $staff->save();

            $content++;
            file_put_contents(storage_path('app/texts/generateValueForStaffs.txt'), $content);

            return redirect()->route('home.colleges')->with('message', 'stored staff details successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'enter valid dept_short_code or check departments!');
        }
    }
    public function updateStaff(Request $request, $id)
    {

        $address_id = $request->input('address_id');
        $address = AddressesModel::find($address_id);
        $address->street_1 = $request->input('street_1');
        $address->street_2 = $request->input('street_2');
        $address->city = $request->input('city');
        $address->state = $request->input('state');
        $address->country = $request->input('country');
        $address->save();

        $staff = StaffsModel::find($id);
        $staff->staff_name = $request->input('staff_name');
        $staff->staff_gender = $request->input('staff_gender');
        $staff->staff_dob = $request->input('staff_dob');
        $staff->mobile_no = $request->input('mobile_no');
        $staff->address_id = $address_id;
        $staff->college_id = $request->input('college_id');
        $staff->dept_short_code = $request->input('dept_short_code');
        $staff->save();

        return redirect()->route('home.colleges')->with('message', 'updated staff details successfully!');
    }
    public function deleteStaffs(Request $request)
    {
        $id = json_decode(urldecode($request->input('data')), true);

        $staff = StaffsModel::find($id);
        if(!empty($staff)) {
            $staff->delete();
        }

        return redirect()->back()->with('message', 'deleted staff details suceessfully!');
    }
    public function updateStfForm(Request $request)
    {
        $id = json_decode(urldecode($request->input('data')), true);
        $staff = StaffsModel::find($id);
        $departments = DepartmentsModel::where('college_id', $staff->college_id)->get();
        return view('StaffsForm', ['staff' => $staff, 'departments' => $departments]);
    }
}
