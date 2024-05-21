<?php
// app/Services/OutletService.php

namespace App\Services;

use App\Models\PaymentMethod;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentMethodService
{
    public function createPayment(array $data)
    {
        DB::beginTransaction();

        try {
            $paymentMethod = PaymentMethod::create([
                'name' => $data['name'],
                'status' => $data['status'],
            ]);

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Payment created: ' . $paymentMethod->name,
            ]);

            DB::commit();

            return $paymentMethod;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updatePayment(PaymentMethod $paymentMethod, array $data)
    {
        DB::beginTransaction();

        try {
            $oldName = $paymentMethod->name; // Store the old name of the outlet

            $paymentMethod->update($data);

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Payment updated: ' . $oldName . ' to ' . $paymentMethod->name,
            ]);

            DB::commit();

            return $paymentMethod;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deletePayment(PaymentMethod $paymentMethod)
    {
        DB::beginTransaction();

        try {
            $paymentName = $paymentMethod->name; // Store the name of the outlet being deleted

            $paymentMethod->delete();

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Payment deleted: ' . $paymentName,
            ]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
