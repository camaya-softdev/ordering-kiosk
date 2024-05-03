<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Services\LocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function index()
    {
        $locations = Location::all();
        return LocationResource::collection($locations);
    }

    public function locationNumbers()
    {
        $locations = Location::with('locationNumbers')->get();
        return LocationResource::collection($locations);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location_code' => 'required|string|max:255|unique:locations',
            'status' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $location = $this->locationService->createLocation($request->only('name', 'location_code', 'status'));

        return response()->json(['location' => new LocationResource($location), 'message' => 'Location created successfully'], 201);
    }

    public function update(Request $request, Location $location)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'location_code' => 'string|max:255|unique:locations,location_code,' . $location->id,
            'status' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $location = $this->locationService->updateLocation($location, $request->only('name', 'location_code', 'status'));

        return response()->json(['location' => new LocationResource($location), 'message' => 'Location updated successfully'], 200);
    }

    public function destroy(Location $location)
    {
        $this->locationService->deleteLocation($location);

        return response()->json(['message' => 'Location deleted successfully'], 200);
    }
}
