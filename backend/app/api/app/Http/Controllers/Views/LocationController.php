<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function index()
    {
        $loginData = session('loginData');
        if ($loginData) {

            // $outlets = Outlet::leftJoin('users', 'outlets.id', '=', 'users.assign_to_outlet')
            // ->select('outlets.*', DB::raw('COUNT(users.id) as user_count'))
            // ->groupBy('outlets.id')
            // ->get();

            $users = User::with('outlet')->get();

            return view('location', ['users' => $users, 'loginData' => $loginData]);

        } else {
            return redirect()->route('login')->with('error', 'Invalid username or password');
        }
    }
}
