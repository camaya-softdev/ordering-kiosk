<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LocationNumber;
use App\Services\LocationNumberService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class LocationNumberController extends Controller
{
    protected $locationNumberService;

    public function __construct(LocationNumberService $locationNumberService)
    {
        $this->locationNumberService = $locationNumberService;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location_id' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $location = $this->locationNumberService->createLocationNumber([
            'name' => $request->input('name'),
            'location_id' => $request->input('location_id'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('location')->with('success', 'Location Number created successfully');

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'location_id' => 'nullable',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->locationNumberService->updateLocationNumber($id, [
            'name' => $request->input('update_ln_name'),
            'location_id' => $request->input('update_location_id'),
            'status' => $request->input('update_ln_status'),
            'updated_at' => now()->setTimezone('Asia/Manila'),
        ]);

        return redirect()->route('location')->with('success', 'Location Number updated successfully');
    }



    public function destroy($id)
    {
        // Call AuthService to delete the user
        $this->locationNumberService->deleteLocationNumber($id);

        // Redirect with success message or handle as needed
        return redirect()->route('location')->with('success', 'Location Number deleted successfully');
    }
}
