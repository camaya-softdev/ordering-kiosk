<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\NewOrder;
use Illuminate\Support\Facades\Log;

class CreateTransactionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $newCustomer = null;
            if ($request->gcashPaymentDetails) {
                $newCustomer = Customer::create([
                    'name' => $request->gcashPaymentDetails['name'],
                    'mobile_number' => $request->gcashPaymentDetails['phoneNumber'],
                ]);
            }else if($request->cashPaymentDetails){
                $newCustomer = Customer::create([
                    'name' => $request->cashPaymentDetails['name'],
                    'mobile_number' => $request->cashPaymentDetails['phoneNumber'],
                ]);
            }

            $newTransaction = Transaction::create([
                'customer_id' => $newCustomer ? $newCustomer->id : null,
                'reference_number' => $request->gcashPaymentDetails['referenceNumber'] ?? null,
                'status' => Transaction::$STATUS_PENDING,
                'remarks' => $request->remarks ?? null,
                'dining_option' => $request->diningOption,
                'payment_method' => $request->paymentOption,
                'location_number_id' => $request->area['id'] ?? null,
            ]);

            foreach ($request->selectedProducts as $product) {
                Log::info('Outlet ID: ' . $product['outlet']['id']);
                // Create a new order for each product
                Order::create([
                    'transaction_id' => $newTransaction->id,
                    'product_id' => $product['details']['id'],
                    'quantity' => $product['quantity'],
                    'outlet_id' => $product['outlet']['id'],
                ]);

                $productToUpdate = Product::where('id', $product['details']['id'])->first();
                if ($productToUpdate) {
                    $productToUpdate->stock -= $product['quantity'];
                    $productToUpdate->save();
                }
            }

            broadcast(new NewOrder($newTransaction))->toOthers();

            DB::commit();

            return response()->json([
                'message' => 'Transaction created successfully',
                'transaction' => $newTransaction,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
