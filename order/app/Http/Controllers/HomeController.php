<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $result_money = DB::table('orders_tables')->sum('result_money');
        $total_customer = DB::table('customer')->count();
        $total_order = DB::table('orders_tables')->count();
        $total_orderdetail = DB::table('order_details')->sum('num');
        $total_product = DB::table('product')->count();
        $total_menu = DB::table('category_menu')->count();
        $total_user = DB::table('users')->count();
        $totalsalary = DB::table('salary')->where('status', 1)->sum('total');

        $neworder = DB::table('orders_tables')
            ->rightJoin('order_details', 'order_details.order_id', 'orders_tables.id')
            ->leftJoin('product','product.id','order_details.product_id')
            ->orderBy('orders_tables.created_at', 'DESC')
            ->select('product.name AS productname','orders_tables.created_at AS created_at')
            ->limit(5)
            ->get();

        return view('home')->with([
            'total_money' => $result_money,
            'total_customer' => $total_customer,
            'total_order' => $total_order,
            'total_orderdetail' => $total_orderdetail,
            'total_product' => $total_product,
            'total_menu' => $total_menu,
            'total_user' => $total_user,
            'totalsalary' => $totalsalary,
            'neworder' => $neworder
        ]);
    }
}
