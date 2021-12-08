<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    public function index()
    {
        $listOrder = DB::table('orders_tables')
            ->leftJoin('customer', 'orders_tables.customer_id', 'customer.id')
            ->select('orders_tables.id', 'orders_tables.table_id', 'orders_tables.result_money', 'orders_tables.discount', 'orders_tables.customer_money', 'orders_tables.back_money', 'orders_tables.created_at', 'customer.name')
            ->orderBy('created_at','DESC')
            ->paginate(8);
        return view('billing.index')
            ->with([
                'listOrder' => $listOrder
            ]);
    }

    public function viewdetail(Request $request)
    {
        $listOrder = DB::table('order_details')
            ->leftJoin('product', 'product.id', 'order_details.product_id')
            ->select('order_details.*', 'product.thumbnail AS thumbnail', 'product.name AS name')
            ->where('order_id', $request->order_id)
            ->get();
            
        return json_encode([
            'status' => 'success',
            'data' => $listOrder
        ]);
    }
}
