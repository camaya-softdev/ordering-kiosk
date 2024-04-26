<?php
// app/Services/OutletService.php

namespace App\Services;

use App\Models\Outlet;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OutletService
{
    public function createOutlet(array $data)
    {
        DB::beginTransaction();

        try {
            $outlet = Outlet::create([
                'name' => $data['name'],
                'image' => $data['image'],
                'status' => $data['status'],
            ]);

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Outlet created: ' . $outlet->name,
            ]);

            DB::commit();

            return $outlet;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateOutlet(Outlet $outlet, array $data)
    {
        DB::beginTransaction();

        try {
            $oldName = $outlet->name; // Store the old name of the outlet

            $outlet->update($data);

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Outlet updated: ' . $oldName . ' to ' . $outlet->name,
            ]);

            DB::commit();

            return $outlet;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteOutlet(Outlet $outlet)
    {
        DB::beginTransaction();

        try {
            $outletName = $outlet->name; // Store the name of the outlet being deleted

            $outlet->delete();

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Outlet deleted: ' . $outletName,
            ]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
