<?php

// app/Http/Controllers/Admin/OutletController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Category;
use App\Services\OutletService;
use App\Http\Resources\OutletResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CategoryResource;

class OutletController extends Controller
{
    protected $outletService;

    public function __construct(OutletService $outletService)
    {
        $this->outletService = $outletService;
    }
    public function index()
    {
        $outlets = Outlet::all();
        return OutletResource::collection($outlets);
    }
    public function OutletCategory($outlet_id)
    {
        $outlet = Outlet::findOrFail($outlet_id);
        $categories = $outlet->categories()->get();;
        return CategoryResource::collection($categories);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'outlet_classification' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $outlet = $this->outletService->createOutlet($request->only('name','status','outlet_classification'));

        return response()->json(['outlet' => new OutletResource($outlet), 'message' => 'Outlet created successfully'], 201);
    }

    public function update(Request $request, Outlet $outlet)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'status' => 'nullable',
            'outlet_classification' => 'string|max:255',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $outlet = $this->outletService->updateOutlet($outlet, $request->only(['name', 'status','outlet_classification']));

        return response()->json(['outlet' => new OutletResource($outlet), 'message' => 'Outlet updated successfully'], 200);
    }

    public function destroy(Outlet $outlet)
    {
        $this->outletService->deleteOutlet($outlet);

        return response()->json(['message' => 'Outlet deleted successfully'], 200);
    }
}

