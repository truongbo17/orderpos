<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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
            // ->where('schedule.datework', $currentDate)
            // ->where('schedule.starttime', '<=', $currentTime)
            // ->where('schedule.endtime', '>=', $currentTime)
            ->select('attendance.id AS att_id','users.name', 'users.avatar', 'users.phone', 'users.type', 'users.status', 'schedule.starttime', 'schedule.endtime', 'schedule.datework', 'attendance.note AS notesecond', 'schedule.note AS notefr')
            ->get();
        // dd($listAtt);
        return view('attendance.index')->with([
            'currentDate' => $currentDate,
            'currentTime' => $currentTime,
            'listAtt' => $listAtt
        ]);
    }

    public function add(Request $requet)
    {
        $datetime = new \DateTime(); //ngày hiện tại
        $currentDate = $datetime->format('Y-m-d'); //format -> 2021-12-05 trùng lặp với cơ sở dũ liệu
        $scheduleList = DB::table('schedule')
            ->where('schedule.datework', '>=', $currentDate)
            ->get();
        return view('attendance.add')->with([
            'scheduleList' => $scheduleList
        ]);
    }

    public function addatt(Request $request)
    {
        $schedule_id = $request->id;
        $schedule = DB::table('schedule')->find($schedule_id);
        $attendance = DB::table('attendance')
            ->rightJoin('users', 'attendance.user_id', 'users.id')
            ->where('schedule_id', $schedule_id)
            ->select('users.name', 'users.id AS user_id')
            ->get();
        // dd($attendance);
        $userList = User::where('type', '!=', 1)->get();
        // dd($userList);

        $arrAtt = [];
        $arrUser = [];
        foreach ($attendance as $item) {
            array_push($arrAtt, $item->user_id);
        }
        foreach ($userList as $item) {
            array_push($arrUser, $item->id);
        }
        $checkUser = array_diff($arrUser,$arrAtt);
        $userList = User::where('type', '!=', 1)->whereIn('id',$checkUser)->get();
        // dd($userList);

        return view('attendance.addatt')->with([
            'schedule' => $schedule,
            'userList' => $userList,
            'attendance' => $attendance
        ]);
    }

    public function postaddatt(Request $request)
    {
        DB::table('attendance')->insert([
            'user_id' => $request->user_id,
            'schedule_id' => $request->schedule_id,
            'note' => $request->note,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return redirect(url()->previous() . '#success')->with('success', 'Thêm nhân viên ca làm này thành công !');
    }

    public function deleteAtt(Request $request)
    {
        $id = $request->att_id;
        DB::table('attendance')->delete($id);
        return 'Cho nhân viên nghỉ làm ca thành công !';
    }
}
