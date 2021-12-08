<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $listProduct = DB::table('users')
            ->rightJoin('product', 'product.user_id', 'users.id')
            ->leftJoin('category_menu', 'category_menu.id', 'product.category_id')
            ->select('product.id', 'product.name', 'product.price', 'product.thumbnail', 'product.description', 'product.status', 'users.name AS username', 'category_menu.name AS category_name')
            ->orderBy('product.updated_at', 'DESC')
            ->paginate(8);

        $listCategory = DB::table('category_menu')->get();
        return view('product.index')->with([
            'listProduct' => $listProduct,
            'listCategory' => $listCategory
        ]);
    }

    public function add(Request $request)
    {
        $user_id = Auth::user()->id;
        $product_id = $request->product_id;
        $name = $request->name;
        $category_id = $request->category_id;
        $price = $request->price;
        $description = $request->description;
        $status = $request->status;

        if ($request->has('thumbnails')) {
            $file = $request->thumbnails;
            $filename = $file->hashName(); // tạo file ngẫu nhiễn
            $file->move(public_path('assets/img/products'), $filename);

            //có ảnh
            if ($product_id > 0) {
                //update
                DB::table('product')->where('id', $product_id)->update([
                    'name' => $name,
                    'user_id' => $user_id,
                    'category_id' => $category_id,
                    'price' => $price,
                    'description' => $description,
                    'thumbnail' => $filename,
                    'status' => $status,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                return redirect(url()->previous() . '#success')->with('success', 'Cập nhật món ăn thành công !');
            } else {
                //insert
                DB::table('product')->insert([
                    'name' => $name,
                    'user_id' => $user_id,
                    'category_id' => $category_id,
                    'price' => $price,
                    'description' => $description,
                    'thumbnail' => $filename,
                    'status' => $status,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                return redirect(url()->previous() . '#success')->with('success', 'Thêm món thành công !');
            }
        } {
            //không ảnh
            if ($product_id > 0) {
                //update
                DB::table('product')->where('id', $product_id)->update([
                    'name' => $name,
                    'user_id' => $user_id,
                    'category_id' => $category_id,
                    'price' => $price,
                    'description' => $description,
                    'status' => $status,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                return redirect(url()->previous() . '#success')->with('success', 'Cập nhật món ăn thành công !');
            } else {
                //insert
                DB::table('product')->insert([
                    'name' => $name,
                    'user_id' => $user_id,
                    'category_id' => $category_id,
                    'price' => $price,
                    'description' => $description,
                    'status' => $status,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                return redirect(url()->previous() . '#success')->with('success', 'Thêm món thành công !');
            }
        }
    }

    public function getinfoproduct(Request $request)
    {
        $product_id  = $request->product_id;
        $infoProduct = DB::table('product')->where('id', $product_id)->get();
        return json_encode([
            'status' => 'success',
            'data' => $infoProduct
        ]);
    }

    public function deleteproduct(Request $request)
    {
        $product_id = $request->product_id;
        DB::table('product')->where('id', $product_id)->delete();
        return redirect(url()->previous() . '#success')->with('success', 'Xóa món thành công !');
    }
}
