<?php

namespace App\Services;

use App\Models\Location;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LocationService
{
    public function createLocation(array $data)
    {
        DB::beginTransaction();

        try {
            $location = Location::create([
                'name' => $data['name'],
                'location_code' => $data['location_code'],
                'status' => $data['status'],
            ]);

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Location created: ' . $location->name,
            ]);

            DB::commit();

            return $location;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateLocation($locationId, array $locationData)
    {
        $location = Location::findOrFail($locationId);

        DB::beginTransaction();

        try {
            $oldLocation = $location->name;

            $location->update($locationData);

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Location updated to: ' . $oldLocation . ' to ' . $location->name,
            ]);

            DB::commit();

            return $location;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteLocation($locationId)
    {
        $location = Location::findOrFail($locationId);

        DB::beginTransaction();

        try {
            $locationName = $location->name; // Store the name of the location being deleted

            $location->delete();

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Location deleted: ' . $locationName,
            ]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
