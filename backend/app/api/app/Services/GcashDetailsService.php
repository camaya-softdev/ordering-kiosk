<?php
// app/Services/OutletService.php

namespace App\Services;

use App\Models\GcashDetails;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GcashDetailsService
{
    public function createGcash(array $data)
    {
        DB::beginTransaction();

        try {
            $gcashDetails = GcashDetails::create([
                'image' => $data['image'],
                'number' => $data['number'],
                'outlet_id' => $data['outlet_id'],
            ]);

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'GCash created: ' . $gcashDetails->number,
            ]);

            DB::commit();

            return $gcashDetails;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updatePayment(GcashDetails $gcashDetails, array $data)
    {
        DB::beginTransaction();

        try {
            $oldName = $gcashDetails->number; // Store the old name of the outlet

            $gcashDetails->update($data);

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'GCash updated: ' . $oldName . ' to ' . $gcashDetails->number,
            ]);

            DB::commit();

            return $gcashDetails;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteGcash(GcashDetails $gcashDetails)
    {
        DB::beginTransaction();

        try {
            $gcashNumber = $gcashDetails->name; // Store the name of the outlet being deleted

            $gcashDetails->delete();

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'GCash deleted: ' . $gcashNumber,
            ]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
