<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Services\PaymentMethodService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;




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
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('public/images');
            $imageUrl = Storage::url($imagePath);
        }

        // return $imageUrl;

        $payment = $this->paymentMethodService->createPayment([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'image' => $imageUrl ?? null,
        ]);


        return redirect()->route('outlet')->with('success', 'Payment Method created successfully');

    }
    public function update(Request $request, PaymentMethod $paymentMethod)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'status' => 'nullable',
            'updateImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle image upload if provided
        if ($request->hasFile('updateImage')) {
            $imagePath = $request->file('updateImage')->store('public/images');
            $imageUrl = Storage::url($imagePath);
        } else {
            $imageUrl = $paymentMethod->image; // Keep the existing image if no new image provided
        }

        $this->paymentMethodService->updatePayment($paymentMethod, [
            'name' => $request->input('name'),
            'status' => $request->input('update_status'),
            'image' => $imageUrl,
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
