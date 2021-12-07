<?php

namespace App\Http\Controllers\LiveSearch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiveSearchController extends Controller
{
    public function livesearchtable(Request $request)
    {
        if ($request->ajax()) {
            $data = '<button class="btn btn-primary" onclick="showAllTable()">Tất cả các bàn</button><h5 class="text-center mb-0 ms-1 text-white">Kết quả tìm kiếm Bàn</h5>';
            $listTable = DB::table('tables')->where('name', 'LIKE', '%' . $request->search . '%')->get();
            // dd($listTable);
            if ($listTable) {
                foreach ($listTable as $item) {
                    if ($item->status == 1) {
                        $status = 'Đã đặt trước';
                    } else {
                        $status = 'Chưa đặt trước';
                    }
                    $data .= '
                        <div class="col-md-3 cursor-pointer">
                            <div class="card bg-gradient-dark move-on-hover">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h5 class="mb-0 text-white">' . $item->name . '</h5>
                                        <div class="ms-auto">
                                            <h1 class="text-white text-end mb-0 mt-n2">
                                            ' . $item->people_number . '</h1>
                                            <p class="text-sm mb-0 text-white"> người</p>
                                        </div>
                                    </div>
                                    <p class="text-white mb-0">Chưa order</p>
                                    <p class="mb-0 text-white">
                                    ' . $status . '
                                    </p>
                                </div>
                                <button class="btn bg-gradient-warning w-100 mb-0 toast-btn"
                                    type="button" data-bs-toggle="modal" data-bs-target="#getProduct"
                                    onclick="chooseTable("' . $item->name . '",' . $item->people_number . ',' . $item->id . '">
                                    <i class="material-icons text-white">store</i>
                                </button>
                            </div>
                        </div>';
                }
            } else {
                $data = 'Không có thông tin về bàn này !';
            }
            return Response($data);
        }
    }


    public function livesearchproduct(Request $request)
    {
        if ($request->ajax()) {
            $data = '<button class="btn btn-primary" onclick="showAllProduct()">Tất cả món ăn</button>';
            $listProduct = DB::table('product')
                ->leftJoin('category_menu', 'category_menu.id', 'product.category_id')
                ->select('category_menu.name AS categoryname', 'product.*')
                ->where('product.name', 'LIKE', '%' . $request->search . '%')
                ->where('product.status', 1)
                ->get();

            // dd($listProduct);
            if ($listProduct) {
                foreach ($listProduct as $item) {
                    $data .= '<div class="col-xl-3 col-md-6 mb-xl-0 mb-4 border cursor-pointer item"
                    style="padding-top: 25px" onclick="valueProduct(this)" field-id="' . $item->id . '"
                    field-thumbnail="' . $item->thumbnail . '"
                    field-name="' . $item->name . '" field-price="' . $item->price . '">
                    <div class="card card-blog card-plain">
                        <div class="card-header p-0 mt-n4 mx-3">
                            <a class="d-block shadow-xl border-radius-xl">
                                <img src="http://127.0.0.1:8000/assets/img/products/' . $item->thumbnail . '"
                                    alt="img-blur-shadow"
                                    class="img-fluid shadow border-radius-xl"
                                    style="height: 128px">
                            </a>
                        </div>
                        <div class="card-body p-3">
                            <p class="mb-0 text-sm">
                            ' . $item->price . 'VNĐ
                            </p>
                            <a href="javascript:;">
                                <h5>
                                ' . $item->name . '
                                </h5>
                            </a>
                            <p class="mb-4 text-sm">
                            ' . $item->description . '
                            </p>
                            <p class="mb-4 text-sm">
                            ' . $item->categoryname . '
                            </p>
                        </div>
                    </div>
                </div>';
                }
            } else {
                $data = 'Không có thông tin về món này !';
            }
            return Response($data);
        }
    }

    public function liveselectproduct(Request $request)
    {
        if ($request->ajax()) {
            $data = '<button class="btn btn-primary" onclick="showAllProduct()">Tất cả món ăn</button>';
            $listProduct = DB::table('product')
                ->leftJoin('category_menu', 'category_menu.id', 'product.category_id')
                ->select('category_menu.name AS categoryname', 'product.*')
                ->where('product.category_id', $request->selected)
                ->where('product.status', 1)
                ->get();

            // dd($listProduct);
            if ($listProduct) {
                foreach ($listProduct as $item) {
                    $data .= '<div class="col-xl-3 col-md-6 mb-xl-0 mb-4 border cursor-pointer item"
                    style="padding-top: 25px" onclick="valueProduct(this)" field-id="' . $item->id . '"
                    field-thumbnail="' . $item->thumbnail . '"
                    field-name="' . $item->name . '" field-price="' . $item->price . '">
                    <div class="card card-blog card-plain">
                        <div class="card-header p-0 mt-n4 mx-3">
                            <a class="d-block shadow-xl border-radius-xl">
                                <img src="http://127.0.0.1:8000/assets/img/products/' . $item->thumbnail . '"
                                    alt="img-blur-shadow"
                                    class="img-fluid shadow border-radius-xl"
                                    style="height: 128px">
                            </a>
                        </div>
                        <div class="card-body p-3">
                            <p class="mb-0 text-sm">
                            ' . $item->price . 'VNĐ
                            </p>
                            <a href="javascript:;">
                                <h5>
                                ' . $item->name . '
                                </h5>
                            </a>
                            <p class="mb-4 text-sm">
                            ' . $item->description . '
                            </p>
                            <p class="mb-4 text-sm">
                            ' . $item->categoryname . '
                            </p>
                        </div>
                    </div>
                </div>';
                }
            } else {
                $data = 'Không có thông tin về món này !';
            }
            return Response($data);
        }
    }
}
