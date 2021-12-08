<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TablesController extends Controller
{
    public function index(Request $request)
    {
        $listTables = Tables::get();
        $allProduct = DB::table('product')
            ->leftJoin('category_menu', 'category_menu.id', 'product.category_id')
            ->select('category_menu.name AS categoryname', 'product.*')
            ->where('product.status', 1)
            ->orderBy('updated_at', 'DESC')
            ->get();
        $allCategory = DB::table('category_menu')->where('status', 1)->get();
        return view('order.tables')->with([
            'listTables' => $listTables,
            'allProduct' => $allProduct,
            'allCategory' => $allCategory
        ]);
    }

    public function getProduct(Request $request)
    {
        $listProduct = DB::table('product')->get();
        return json_encode([
            'status' => 'success',
            'data' => $listProduct
        ]);
    }

    public function submitorder(Request $request)
    {
        // dd($request);
        $customer = DB::table('customer')->where('phone', $request->customer)->first();
        if ($customer == null) {
            $customer = 1;
        } else {
            $customer = $customer->id;
        }
        // dd($customer);
        $order_id = DB::table('orders_tables')->insertGetId([
            'customer_id' => $customer,
            'table_id' => $request->table_id,
            'result_money' => $request->result,
            'discount' => $request->discount,
            'customer_money' => $request->customer_money,
            'back_money' => $request->back_money,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        foreach ($request->data as $item) {
            // dd($item['table_id']);
            DB::table('order_details')->insert([
                'order_id' => $order_id,
                'product_id' => $item['product_id'],
                'price' => $item['price'],
                'num' => $item['num'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        return "success";
    }
}
