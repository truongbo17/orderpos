<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\EditUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $listUser = User::all();
        return view('user.index')->with([
            'index' => 1,
            'listUser' => $listUser
        ]);
    }

    public function add()
    {
        return view('user.add');
    }

    public function postAdd(UserRequest $request)
    {
        if ($request->has('thumbnail')) {
            $file = $request->thumbnail;
            $filename = $file->hashName(); // tạo file ngẫu nhiễn
            $file->move(public_path('assets/img/avatar'), $filename);
        }
        $request->merge(['avatar' => $filename]);
        $request->password = Hash::make($request->password);
        $request->merge(['status' => 0]);
        // dd($request->avatar);
        if (User::create($request->all())) {
            return redirect(url()->previous() . '#success')->with('success', 'Thêm nhân viên thành công !');
        }
        // return view('user.add');
    }

    public function edit(Request $request)
    {
        $userInfo = User::find($request->user_id);
        // dd($userInfo);
        return view('user.edit')->with([
            'userInfo' => $userInfo
        ]);
    }

    public function postEdit(EditUserRequest $request)
    {
        if ($request->has('thumbnail')) {
            $file = $request->thumbnail;
            $filename = $file->hashName(); // tạo file ngẫu nhiễn
            $file->move(public_path('assets/img/avatar'), $filename);

            $request->merge(['avatar' => $filename]); //upload có ảnh
            if ($request->password == null || $request->password == null) {
                //update không đổi pass
                User::where('id', $request->user_id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'avatar' => $request->avatar,
                        'type' => $request->type,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            } else {
                $request->password = Hash::make($request->password);
                //update có pass
                User::where('id', $request->user_id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'avatar' => $request->avatar,
                        'password' => $request->password,
                        'type' => $request->type,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            }
        } else {
            if ($request->password == null || $request->password == null) {
                //update không đổi pass
                User::where('id', $request->user_id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'type' => $request->type,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            } else {
                $request->password = Hash::make($request->password);
                //update có pass
                User::where('id', $request->user_id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'password' => $request->password,
                        'type' => $request->type,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            }
        }

        return redirect(url()->previous() . '#success')->with('success', 'Cập nhật tài khoản thành công !');
    }

    public function updateStatusWorkBack(Request $request)
    {
        $checkStatusUser = User::find($request->user_id);

        if ($checkStatusUser->status == 2) {
            User::where('id', $request->user_id)
                ->update([
                    'status' => 0,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        } else {
            User::where('id', $request->user_id)
                ->update([
                    'status' => 2,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }
    }

    public function profile(Request $request)
    {
        $datetime = new \DateTime(); //ngày hiện tại
        $currentDate = $datetime->format('Y-m-d'); //format -> 2021-12-05 trùng lặp với cơ sở dũ liệu

        $listAtt = DB::table('users')
            ->leftJoin('attendance', 'attendance.user_id', 'users.id')
            ->rightJoin('schedule', 'schedule.id', 'attendance.schedule_id')
            ->select('users.name', 'users.avatar', 'users.phone', 'users.type', 'users.status', 'schedule.starttime', 'schedule.endtime', 'schedule.datework', 'attendance.note AS notesecond', 'schedule.note AS notefr')
            ->get();

        $userInfo = Auth::user();
        // dd($userInfo);
        return view('user.profile')->with([
            'currentDate' => $currentDate,
            'userInfo' => $userInfo,
            'listAtt' => $listAtt
        ]);
    }

    public function profileEdit(Request $request)
    {
        $userInfo = Auth::user();
        // dd($userInfo);
        return view('user.edit')->with([
            'userInfo' => $userInfo
        ]);
    }


    public function postProfileEdit(EditUserRequest $request)
    {
        if ($request->has('thumbnail')) {
            $file = $request->thumbnail;
            $filename = $file->hashName(); // tạo file ngẫu nhiễn
            $file->move(public_path('assets/img/avatar'), $filename);

            $request->merge(['avatar' => $filename]); //upload có ảnh
            if ($request->password == null || $request->password == null) {
                //update không đổi pass
                User::where('id', $request->user_id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'avatar' => $request->avatar,
                        'type' => $request->type,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            } else {
                $request->password = Hash::make($request->password);
                //update có pass
                User::where('id', $request->user_id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'avatar' => $request->avatar,
                        'password' => $request->password,
                        'type' => $request->type,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            }
        } else {
            if ($request->password == null || $request->password == null) {
                //update không đổi pass
                User::where('id', $request->user_id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'type' => $request->type,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            } else {
                $request->password = Hash::make($request->password);
                //update có pass
                User::where('id', $request->user_id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'password' => $request->password,
                        'type' => $request->type,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            }
        }

        return redirect(url()->previous() . '#success')->with('success', 'Cập nhật tài khoản thành công !');
    }
}
