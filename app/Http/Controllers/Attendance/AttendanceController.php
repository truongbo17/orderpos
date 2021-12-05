<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index()
    {
        $datetime = new \DateTime(); //ngày hiện tại
        $currentDate = $datetime->format('Y-m-d'); //format -> 2021-12-05 trùng lặp với cơ sở dũ liệu
        $hour = $datetime->format('H');
        $minute = $datetime->format('i');
        $currentTime = $hour + ($minute / 60); //format ra giwof hiện tại

        $listAtt = DB::table('users')
            ->leftJoin('attendance', 'attendance.user_id', 'users.id')
            ->rightJoin('schedule', 'schedule.id', 'attendance.schedule_id')
            ->where('schedule.datework', $currentDate)
            ->where('schedule.starttime', '<=', $currentTime)
            ->where('schedule.endtime', '>=', $currentTime)
            ->get();
        return view('attendance.index')->with([
            'listAtt' => $listAtt
        ]);
    }
}
