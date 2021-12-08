<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $listCustomer = DB::table('customer')->orderBy('updated_at', 'DESC')->paginate(8);
        return view('customer.index')->with([
            'listCustomer' => $listCustomer
        ]);
    }

    public function add(Request $request)
    {
        // dd($request);
        $customer_id = $request->customer_id;
        $name = $request->name;
        $phone = $request->phone;
        $note = $request->note;
        $status = $request->status;
        if ($customer_id > 0) {
            //update
            DB::table('customer')->where('id', $customer_id)->update([
                'name' => $name,
                'phone' => $phone,
                'note' => $note,
                'status' => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            return redirect(url()->previous() . '#success')->with('success', 'Cập nhật khách hàng thành công !');
        } else {
            //insert
            DB::table('customer')->insert([
                'name' => $name,
                'phone' => $phone,
                'note' => $note,
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            return redirect(url()->previous() . '#success')->with('success', 'Thêm khách hàng thành công !');
        }
    }

    public function getinfo(Request $request)
    {
        $customer_id = $request->customer_id;
        $infoCustomer = DB::table('customer')->where('id', $customer_id)->get();
        return json_encode([
            'status' => 'success',
            'data' => $infoCustomer
        ]);
    }

    public function delete(Request $request)
    {
        $customer_id = $request->customer_id;
        DB::table('customer')->where('id', $customer_id)->delete();
        return redirect(url()->previous() . '#success')->with('success', 'Xóa khách hàng thành công !');
    }

    public function getorder(Request $request)
    {
        $listOrder = DB::table('orders_tables')
            ->where('customer_id', $request->customer_id)
            ->get();
        return json_encode([
            'status' => 'success',
            'data' => $listOrder
        ]);
    }
}
