<?php


namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Exports\ActivityLogExport;
use Maatwebsite\Excel\Facades\Excel;

class ActivitylogController extends Controller
{
    public function index()
    {
        $loginData = session('loginData');
        $outlet_id = $loginData['user']['assign_to_outlet'];

        if ($loginData) {


            $activityLog = Log::leftJoin('users', 'users.id','logs.user_id')
            ->where("users.assign_to_outlet", $outlet_id)
            ->select('logs.*', 'users.username')
            ->orderBy("logs.date","desc")
            ->get();


            $users = User::with('outlet')->get();

            return view('Pages.activityLogs', ['users' => $users,'activityLog' => $activityLog, 'loginData' => $loginData]);

        } else {
            return redirect()->route('login')->with('error', 'Invalid username or password');
        }
    }
    public function exportLogs(Request $request)
    {

        $selectedDate = $request->input('selectedDate');
        $loginData = session('loginData');
        $outlet_id = $loginData['user']['assign_to_outlet'];

        $activityLog = Log::leftJoin('users', 'users.id','logs.user_id')
        ->where("users.assign_to_outlet", $outlet_id)
        ->whereDate('logs.created_at', $selectedDate)
        ->select('logs.*', 'users.username')
        ->orderBy("logs.date","desc")
        ->get();


        return Excel::download(new ActivityLogExport($activityLog), 'activity_logs.xlsx');
        // return response()->json($activityLog);
    }

}

