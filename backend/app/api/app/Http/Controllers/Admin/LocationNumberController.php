<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LocationNumber;
use App\Services\LocationNumberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\LocationNumberResource;

class LocationNumberController extends Controller
{
    protected $locationNumberService;

    public function __construct(LocationNumberService $locationNumberService)
    {
        $this->locationNumberService = $locationNumberService;
    }

    public function index()
    {
        $locationNumbers = LocationNumber::all();
        return LocationNumberResource::collection($locationNumbers);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'status' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $locationNumber = $this->locationNumberService->createLocationNumber($request->all());

        return response()->json(['location_number' => new LocationNumberResource($locationNumber), 'message' => 'Location number created successfully'], 201);
    }

    public function update(Request $request, LocationNumber $locationNumber)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'location_id' => 'exists:locations,id',
            'status' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $locationNumber->update($request->all());

        return response()->json(['location_number' => new LocationNumberResource($locationNumber), 'message' => 'Location number updated successfully'], 200);
    }

    public function destroy(LocationNumber $locationNumber)
    {
        $locationNumber->delete();

        return response()->json(['message' => 'Location number deleted successfully'], 200);
    }
}
