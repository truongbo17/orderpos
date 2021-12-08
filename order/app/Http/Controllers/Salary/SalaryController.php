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
            ->select('users.id', 'users.name', 'users.avatar', 'users.phone', 'users.type', 'users.created_at', DB::raw('COUNT(attendance.id) AS sumworktime'))
            ->groupBy('users.id', 'users.name', 'users.avatar', 'users.phone', 'users.type', 'users.created_at')
            ->get();
        // dd($listUser);
        $listSalary = DB::table('salary')
            ->leftJoin('users', 'salary.user_id', 'users.id')
            ->select('users.name', 'users.avatar', 'users.phone', 'users.type', 'users.created_at', 'salary.*')
            ->get();
        return view('salary.index')->with([
            'listUser' => $listUser,
            'listSalary' => $listSalary
        ]);
    }

    public function submitSalary(Request $request)
    {
        $user_id = $request->user_id;
        $worktime = $request->worktime;
        $wage = $request->wage;
        $bonus = $request->bonus;
        $total = $request->total;

        $salary_id = DB::table('salary')->insertGetId([
            'user_id' => $user_id,
            'worktime' => $worktime,
            'wage' => $wage,
            'bonus' => $bonus,
            'total' => $total,
            'status' => 0,
            'user_id' => $user_id,
            'user_id' => $user_id,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $userSalary = DB::table('salary')
            ->leftJoin('users', 'salary.user_id', 'users.id')
            ->where('salary.id', $salary_id)
            ->select('users.name', 'users.avatar', 'users.phone', 'users.type', 'users.created_at AS usercreated_at', 'salary.*')
            ->get();

        DB::table('attendance')
            ->where('user_id', $user_id)
            ->where('status', 1)
            ->update(['status' => 0]);

        $data = [
            "status" => "success",
            "data" => $userSalary
        ];

        return json_encode($data);
    }

    public function submitPaySalary(Request $request)
    {
        $salary_id = $request->id;
        DB::table('salary')->where('id', $salary_id)->update(['status' => 1, 'updated_at' => date('Y-m-d H:i:s')]);
        return "success";
    }
}
