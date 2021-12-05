<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Tables;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    public function index(Request $request)
    {
        $listTables = Tables::get();
        return view('order.tables')->with([
            'listTables' => $listTables
        ]);
    }
}
