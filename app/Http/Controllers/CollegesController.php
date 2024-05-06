<?php

namespace App\Http\Controllers;

use App\Models\AddressesModel;
use App\Models\CollegesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollegesController extends Controller
{
    public function index(Request $request)
    {
        // $colleges = CollegesModel::all();
        // return view('index', ["colleges" => $colleges]);

        $perPage = $request->input('rowsPerPage', 5);
        $colleges = CollegesModel::paginate($perPage);
        return view('index', compact('colleges'));
    }
    public function store(Request $request)
    {
        $address = new AddressesModel();
        $address->street_1 = $request->input('street_1');
        $address->street_2 = $request->input('street_2');
        $address->city = $request->input('city');
        $address->state = $request->input('state');
        $address->country = $request->input('country');
        $address->save();

        $college = new CollegesModel();
        $college->college_name = $request->input('college_name');
        $college->address_id = AddressesModel::latest()->value('address_id');
        $college->save();

        return redirect()->route('home.colleges')->with('success', 'stored college successfully!');
    }

    public function updateClgForm(Request $request)
    {
        $id = $request->input('data');
        $college = CollegesModel::find($id);
        return view('CollegesForm', ['college' => $college]);
    }
    public function updateCollege(Request $request, $id)
    {
        $address_id = $request->input('address_id');
        $address = AddressesModel::find($address_id);
        $address->street_1 = $request->input('street_1');
        $address->street_2 = $request->input('street_2');
        $address->city = $request->input('city');
        $address->state = $request->input('state');
        $address->country = $request->input('country');
        $address->save();

        $college = CollegesModel::find($id);
        $college->college_name = $request->input('college_name');
        $college->save();

        return redirect()->route('home.colleges')->with('success', 'updated college details successfully!');
    }
    public function deleteColleges(Request $request)
    {
        $id = json_decode(urldecode($request->input('data')), true);

        $college = CollegesModel::find($id);
        if (!empty($college)) {
            $college->delete();
        }
        return redirect()->back()->with('success', 'deleted college details suceessfully!');
    }
    public function search(Request $request)
    {
        $value = $request->input('data');
        $colleges = CollegesModel::where('college_name', 'LIKE', '%' . $value . '%')->get();
        return view('SearchedColleges', ["colleges" => $colleges]);
    }
}
