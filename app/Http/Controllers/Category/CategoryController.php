<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $category = DB::table('category_menu')
            ->leftJoin('product', 'product.category_id', 'category_menu.id')
            ->select('category_menu.id', 'category_menu.name', 'category_menu.status', 'category_menu.updated_at', DB::raw('COUNT(product.id) AS countproduct'))
            ->groupBy('category_menu.id', 'category_menu.name', 'category_menu.status', 'category_menu.updated_at')
            ->get();
        return view('category.index')->with(['category' => $category]);
    }

    public function viewProduct(Request $request)
    {
        $category_id  = $request->category_id;
        $listProduct = DB::table('product')->where('category_id', $category_id)->get();
        return json_encode([
            'status' => 'success',
            'data' => $listProduct
        ]);
    }

    public function addCategory(Request $request)
    {
        $category_id = $request->category_id;
        if ($category_id > 0) {
            //update
            $name = $request->name;
            $status = $request->status;

            $listProduct = DB::table('product')->where('category_id', $category_id)->where('status', 1)->get();
            if ($listProduct != null && $listProduct != '' && count($listProduct) > 0) {
                //ẩn tất cả product của category 
                DB::table('product')->where('category_id', $category_id)->update(['status' =>  0]);
                DB::table('category_menu')->where('id', $category_id)->update([
                    'name' => $name,
                    'status' => $status,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                return redirect(url()->previous() . '#error')->with('error', 'Ẩn tất cả món ăn thuộc menu thành công !');
            } else {
                DB::table('category_menu')->where('id', $category_id)->update([
                    'name' => $name,
                    'status' => $status,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                return redirect(url()->previous() . '#success')->with('success', 'Cập nhật menu thành công !');
            }
        } else {
            //insert
            $name = $request->name;
            $status = $request->status;
            DB::table('category_menu')->insert([
                'name' => $name,
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            return redirect(url()->previous() . '#success')->with('success', 'Thêm menu thành công !');
        }
    }

    public function editCategory(Request $request)
    {
        $category_id  = $request->category_id;
        $infoCategory = DB::table('category_menu')->where('id', $category_id)->get();
        return json_encode([
            'status' => 'success',
            'data' => $infoCategory
        ]);
    }

    public function deleteCategory(Request $request)
    {
        $category_id = $request->category_id;

        $listProduct = DB::table('product')->where('category_id', $category_id)->where('status', 1)->get();

        if ($listProduct != null && $listProduct != '' && count($listProduct) > 0) {
            //không được ẩn
            return redirect(url()->previous() . '#error')->with('error', 'Không thể Xóa menu này vì nó chứa các món ăn !');
        } else {
            DB::table('category_menu')->where('id', $category_id)->delete();
            return redirect(url()->previous() . '#success')->with('success', 'Xóa menu thành công !');
        }
    }

}
