<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Services\PaymentMethodService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class PaymentMethodController extends Controller
{
    protected $paymentMethodService;

    public function __construct(PaymentMethodService $paymentMethodService)
    {
        $this->paymentMethodService = $paymentMethodService;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $payment = $this->paymentMethodService->createPayment([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('outlet')->with('success', 'Payment Method created successfully');

    }
    public function update(Request $request, PaymentMethod $paymentMethod)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'status' => 'nullable',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->paymentMethodService->updatePayment($paymentMethod, [
            'name' => $request->input('name'),
            'status' => $request->input('update_status'),
            'updated_at' => now()->setTimezone('Asia/Manila'),
        ]);

        return redirect()->route('outlet')->with('success', 'Payment updated successfully');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        // Call AuthService to delete the user
        $this->paymentMethodService->deletePayment($paymentMethod);

        // Redirect with success message or handle as needed
        return redirect()->route('outlet')->with('success', 'Payment deleted successfully');
    }

}
