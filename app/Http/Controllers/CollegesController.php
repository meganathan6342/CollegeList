<?php

namespace App\Http\Controllers;

use App\Services\CollegesService;
use Illuminate\Http\Request;

class CollegesController extends Controller
{
    protected $collegesService;

    public function __construct(CollegesService $collegesService)
    {
        $this->collegesService = $collegesService;
    }
    public function index(Request $request)
    {
        $perPage = $request->input('rowsPerPage', 5);
        $colleges = $this->collegesService->getAllColleges($perPage);
        return view('index', compact('colleges'));
    }

    public function store(Request $request)
    {
        $street_1 = $request->input('street_1');
        $street_2 = $request->input('street_2');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');
        $address = array('street_1' => $street_1, 'street_2' => $street_2, 'city' => $city, 'state' => $state, 'country' => $country);

        $college_name = $request->input('college_name');
        $college = array('college_name' => $college_name);

        $data = $this->collegesService->storeCollege($college, $address);

        if (is_array($data)) {
            return redirect()->back()->withErrors($data)->withInput();
        }
        return redirect()->back()->with('message', 'college details stored successfully!');
    }

    public function edit(Request $request)
    {
        $college_id = $request->input('data');
        $college = $this->collegesService->getCollegeById($college_id);
        return view('CollegesForm', ['college' => $college]);
    }
    public function update(Request $request, $college_id)
    {
        $address_id = $request->input('address_id');
        $street_1 = $request->input('street_1');
        $street_2 = $request->input('street_2');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');
        $address = array('address_id' => $address_id, 'street_1' => $street_1, 'street_2' => $street_2, 'city' => $city, 'state' => $state, 'country' => $country);


        $college_name = $request->input('college_name');
        $college = array('college_id' => $college_id, 'college_name' => $college_name);

        $data = $this->collegesService->updateCollege($college, $address);

        if (is_array($data)) {
            return redirect()->back()->withErrors($data)->withInput();
        }
        return redirect()->back()->with('message', 'updated college details successfully!');
    }
    public function delete(Request $request)
    {
        $college_id = json_decode(urldecode($request->input('data')), true);

        $data = $this->collegesService->deleteCollege($college_id);
        return redirect()->back()->with('message', 'deleted college details suceessfully!');
    }
    public function search(Request $request)
    {
        $value = $request->input('data');
        $colleges = $this->collegesService->searchCollege($value);
        return view('SearchedColleges', ["colleges" => $colleges]);
    }
}
