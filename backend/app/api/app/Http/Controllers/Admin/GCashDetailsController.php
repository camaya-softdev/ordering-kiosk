<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\GCashDetailsResource;
use App\Models\GcashDetails;
use Illuminate\Http\Request;

class GCashDetailsController extends Controller
{
    public function index(Request $request)
    {
        $locations = GcashDetails::when($request->has('outlet_id'), function($query) use ($request) {
                return $query->where('outlet_id', $request->outlet_id);
            })
            ->get();
            
        return GCashDetailsResource::collection($locations);
    }
}
