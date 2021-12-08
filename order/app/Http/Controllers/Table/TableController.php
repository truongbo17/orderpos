<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    public function index()
    {
        $listTable = DB::table('tables')->paginate(8);
        return view('table.index')->with([
            'listTable' => $listTable
        ]);
    }

    public function add(Request $request)
    {
        // dd($request);
        $table_id = $request->table_id;
        $name = $request->name;
        $people_number = $request->people_number;
        $status = $request->status;
        if ($table_id > 0) {
            //update
            DB::table('tables')->where('id', $table_id)->update([
                'name' => $name,
                'people_number' => $people_number,
                'status' => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            return redirect(url()->previous() . '#success')->with('success', 'Cập nhật bàn thành công !');
        } else {
            //insert
            DB::table('tables')->insert([
                'name' => $name,
                'people_number' => $people_number,
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            return redirect(url()->previous() . '#success')->with('success', 'Thêm bàn thành công !');
        }
    }

    public function getinfo(Request $request)
    {
        $table_id = $request->table_id;
        $infoTable = DB::table('tables')->where('id', $table_id)->get();
        return json_encode([
            'status' => 'success',
            'data' => $infoTable
        ]);
    }

    public function delete(Request $request)
    {
        $table_id = $request->table_id;
        DB::table('tables')->where('id', $table_id)->delete();
        return redirect(url()->previous() . '#success')->with('success', 'Xóa bàn thành công !');
    }
}
