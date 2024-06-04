<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GcashDetails;
use App\Services\GcashDetailsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;




class GcashDetailsController extends Controller
{
    protected $gcashDetailsService;

    public function __construct(GcashDetailsService $gcashDetailsService)
    {
        $this->gcashDetailsService = $gcashDetailsService;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
            'number' => 'required|string|max:255',
            'outlet_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('public/images');
            $imageUrl = Storage::url($imagePath);
        }

        // return $imageUrl;

        $gcash = $this->gcashDetailsService->createGcash([
            'number' => $request->input('number'),
            'outlet_id' => $request->input('outlet_id'),
            'image' => $imageUrl ?? null,
        ]);


        return redirect()->route('outlet')->with('success', 'GCash Details created successfully');

    }
    public function update(Request $request, GcashDetails $gcashDetails)
    {
        // return $request;

        $validator = Validator::make($request->all(), [
            'number' => 'nullable|string|max:255',
            'outlet_id' => 'nullable',
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
            $imageUrl = $gcashDetails->image; // Keep the existing image if no new image provided
        }

        $this->gcashDetailsService->updatePayment($gcashDetails, [
            'number' => $request->input('number'),
            'outlet_id' => $request->input('outlet_id'),
            'image' => $imageUrl,
            'updated_at' => now()->setTimezone('Asia/Manila'),
        ]);

        return redirect()->route('outlet')->with('success', 'GCash Details updated successfully');
    }

    public function destroy(GcashDetails $gcashDetails)
    {
        // Call AuthService to delete the user
        $this->gcashDetailsService->deleteGcash($gcashDetails);

        // Redirect with success message or handle as needed
        return redirect()->route('outlet')->with('success', 'GCash Details deleted successfully');
    }

}
