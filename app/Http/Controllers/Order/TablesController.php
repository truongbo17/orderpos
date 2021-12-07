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
}
