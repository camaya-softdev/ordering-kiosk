<?php


namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Category;
use App\Services\OutletService;
use App\Http\Resources\OutletResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class OutletController extends Controller
{
    protected $outletService;

    public function __construct(OutletService $outletService)
    {
        $this->outletService = $outletService;
    }
    public function index()
    {
        $loginData = session('loginData');
        if ($loginData) {

            $outlets = Outlet::leftJoin('users', 'outlets.id', '=', 'users.assign_to_outlet')
            ->select('outlets.*', DB::raw('COUNT(users.id) as user_count'))
            ->groupBy('outlets.id')
            ->get();


            return view('outlet', ['outlets' => $outlets, 'loginData' => $loginData]);

        } else {
            return redirect()->route('login')->with('error', 'Invalid username or password');
        }
    }
    // public function OutletCategory($outlet_id)
    // {
    //     $outlet = Outlet::findOrFail($outlet_id);
    //     $categories = $outlet->categories()->where('status', 1)->get();;
    //     return CategoryResource::collection($categories);
    // }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle image upload
        $imagePath = $request->file('image')->store('public/images');
        $imageUrl = Storage::url($imagePath);

        $outlet = $this->outletService->createOutlet([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'image' => $imageUrl,
        ]);

        return redirect()->route('outlet')->with('success', 'Outlet created successfully');

    }

    public function update(Request $request, Outlet $outlet)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imageUrl = Storage::url($imagePath);
        } else {
            $imageUrl = $outlet->image; // Keep the existing image if no new image provided
        }

        $this->outletService->updateOutlet($outlet, [
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'updated_at' => now()->setTimezone('Asia/Manila'),
            'image' => $imageUrl,
        ]);

        return redirect()->route('outlet')->with('success', 'Outlet updated successfully');
    }

    public function destroy(Outlet $outlet)
    {
        $this->outletService->deleteOutlet($outlet);

        return redirect()->route('outlet')->with('success', 'Outlet deleted successfully');
    }
}

