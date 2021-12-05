<?php

namespace App\Http\Controllers\Salary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        $listUser = DB::table('users')
            ->rightJoin('attendance', 'attendance.user_id', 'users.id')
            ->where('attendance.status', '=', 1)
            ->select('users.id','users.name','users.avatar','users.phone','users.type','users.created_at', DB::raw('SUM(attendance.id) AS sumworktime'))
            ->groupBy('users.id','users.name','users.avatar','users.phone','users.type','users.created_at')
            ->get();
        // dd($listUser);
        return view('salary.index')->with([
            'listUser' => $listUser
        ]);
    }
}
