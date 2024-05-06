<?php

namespace App\Services;

use App\Models\LocationNumber;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LocationNumberService
{
    public function createLocationNumber(array $data)
    {
        DB::beginTransaction();

        try {
            $locationNumber = LocationNumber::create([
                'name' => $data['name'],
                'location_id' => $data['location_id'],
                'status' => $data['status'],
            ]);

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Location number created: ' . $locationNumber->name,
            ]);

            DB::commit();

            return $locationNumber;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateLocationNumber($locationNumberId, array $data)
    {
        $locationNumber = LocationNumber::findOrFail($locationNumberId);

        DB::beginTransaction();

        try {
            $oldName = $locationNumber->name; // Store the old name of the location number

            $locationNumber->update($data);

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Location number updated: ' . $oldName . ' to ' . $locationNumber->name,
            ]);

            DB::commit();

            return $locationNumber;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteLocationNumber($locationNumberId)
    {
        $locationNumber = LocationNumber::findOrFail($locationNumberId);

        DB::beginTransaction();

        try {
            $locationNumberName = $locationNumber->name; // Store the name of the location number being deleted

            $locationNumber->delete();

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Location number deleted: ' . $locationNumberName,
            ]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
