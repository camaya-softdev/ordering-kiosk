<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Outlet;
use App\Services\LocationService;
use App\Models\Location;
use App\Models\LocationNumber;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class LocationController extends Controller
{
    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function index()
    {
        $loginData = session('loginData');
        if ($loginData) {

            $locations = Location::with('outlet')->get();
            $outlets = Outlet::all();

            $locationNumbers = LocationNumber::
            leftJoin('locations', 'locations.id', 'location_numbers.location_id')
            ->select('locations.name as location_name', 'location_numbers.*')->
            get();

            $users = User::with('outlet')->get();

            return view('location', ['locationNumbers' => $locationNumbers,'locations' => $locations,'users' => $users, 'outlets' => $outlets,'loginData' => $loginData]);

        } else {
            return redirect()->route('login')->with('error', 'Invalid username or password');
        }
    }

    public function store(Request $request)
    {
        // return $request;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location_code' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $location = $this->locationService->createLocation([
            'name' => $request->input('name'),
            'location_code' => $request->input('location_code'),
            'outlet_id' => $request->input('outlet_id'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('location')->with('success', 'Location created successfully');

    }
    public function update(Request $request, Location $location)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'location_code' => 'nullable',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->locationService->updateLocation($location, [
            'name' => $request->input('update_name'),
            'status' => $request->input('update_status'),
            'outlet_id' => $request->input('update_outlet_id'),
            'location_code' => $request->input('update_location_code'),
            'updated_at' => now()->setTimezone('Asia/Manila'),
        ]);

        return redirect()->route('location')->with('success', 'Location updated successfully');
    }

    public function destroy($id)
    {
        // Call AuthService to delete the user
        $this->locationService->deleteLocation($id);

        // Redirect with success message or handle as needed
        return redirect()->route('location')->with('success', 'Location deleted successfully');
    }

}
