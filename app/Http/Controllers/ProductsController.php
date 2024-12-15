<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    //
    public function getProductList() {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('admin.product', compact('products'));
    }
    public function getProductAdd() {
        $products = Product::all();
        return view('admin.modal.Product_add', compact('products'));
    }
    public function postProductAdd(Request $request)
    {
        if ($request->hasfile('image')) {
            $this->validate($request, [
                'id_type' => 'required',
                'unit_price' => 'required|numeric',
                'unit' => 'required',
                'image' => 'mimes:jpg,png,gif,jpeg|max: 2048',
                'description' => 'required',
                'name' => 'required',
               
            ], [
                    'image.mimes' => 'Chỉ chấp nhận file hình ảnh',
                    'image.max' => 'Chỉ chấp nhận hình ảnh dưới 2Mb',
                    'description.required' => 'Bạn chưa nhập mô tả',
                    'name.required' => 'Bạn chưa nhập name',
                    'id_type.required' => 'Bạn chưa nhập loại bánh',
                    'unit.required' => 'Bạn chưa nhập loại đóng gói',
                    'unit_price.required' => 'Bạn chưa nhập giá bánh',
                    
                   
                   
                ]);
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('source/image/product'); //project\public\images, public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/product
        } else {
            $this->validate($request, [
                'id_type' => 'required',
                'unit_price' => 'required|numeric',
                'unit' => 'required',
                'description' => 'required',
                'name' => 'required',
               
                'image' => 'required',
            ], [
                'id_type.required' => 'Bạn chưa nhập loại bánh',
                'unit.required' => 'Bạn chưa nhập loại đóng gói',
                'unit_price.required' => 'Bạn chưa nhập giá bánh',
                    'description.required' => 'Bạn chưa nhập mô tả',
                    'name.required' => 'Bạn chưa nhập name',
                   
                    'image.required' => 'Bạn chưa chọn hình ảnh',
                ]);
        }
        $product = new Product;
        $product->description = $request->description; 
        $product->name = $request->name;
        $product->image = $name;
        $product->unit_price = $request->unit_price;
        $product->id_type = $request->id_type;
        $product->promotion_price = 0;
        $product->unit = $request->unit;
        $product->new = 1;
       
        
       
        $product->save();
        return redirect()->back()->with('success','Thêm sản phẩm thành công');
    }
    //
    public function getProductEdit(string $id) {
         $product = Product::find($id);
        $type_product = Category::all();
        return view('admin.modal.Product_edit', compact('product','type_product'));
    }
    
    public function postProductEdit(Request $request, string $id) {
        if ($request->hasfile('image')) {
            $this->validate($request, [
                'id_type' => 'required',
                'unit_price' => 'required|numeric',
                'unit' => 'required',
                'image' => 'mimes:jpg,png,gif,jpeg|max: 2048',
                'description' => 'required',
                'name' => 'required',
               
            ], [
                    'image.mimes' => 'Chỉ chấp nhận file hình ảnh',
                    'image.max' => 'Chỉ chấp nhận hình ảnh dưới 2Mb',
                    'description.required' => 'Bạn chưa nhập mô tả',
                    'name.required' => 'Bạn chưa nhập name',
                    'id_type.required' => 'Bạn chưa nhập loại bánh',
                    'unit.required' => 'Bạn chưa nhập loại đóng gói',
                    'unit_price.required' => 'Bạn chưa nhập giá bánh',
                    
                   
                   
                ]);
            $file = $request->file('image');
            $imgname = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('source/image/product'); //project\public\images, public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $imgname); //lưu hình ảnh vào thư mục public/product
        } else {
            $this->validate($request, [
                'id_type' => 'required',
                'unit_price' => 'required|numeric',
                'unit' => 'required',
                'description' => 'required',
                'name' => 'required',
               
                'image' => 'required',
            ], [
                'id_type.required' => 'Bạn chưa nhập loại bánh',
                'unit.required' => 'Bạn chưa nhập loại đóng gói',
                'unit_price.required' => 'Bạn chưa nhập giá bánh',
                    'description.required' => 'Bạn chưa nhập mô tả',
                    'name.required' => 'Bạn chưa nhập name',
                   
                    'image.required' => 'Bạn chưa chọn hình ảnh',
                ]);
        }
        
        $description = $request->description; 
        $name = $request->name;
        $image = $imgname;
        $unit_price = $request->unit_price;
        $id_type = $request->id_type;
        $promotion_price = $request->promotion_price;
        $unit = $request->unit;
        $new = 1;
       
        DB::table('products')->where('id', $id)->update([
            'description' =>   $description ,
            'name' =>  $name,
           
            'image'=> $image,
            'unit_price' => $unit_price,
            'id_type' => $id_type,
            'promotion_price' => $promotion_price,
            'unit' => $unit,
            'new' => $new,
            
        ]);
        return redirect(route('admin.getProductList'))->with('success','Cập nhật sản phẩm thành công!');
       
        // return redirect()->back()->with('success','Sửa sản phẩm thành công');
    }

//
    public function getProductDelete( string $id)
    {
        //
       Product::find($id)->delete();
        // $id->delete();
        return redirect()->back()->with('success','Xóa sản phẩm thành công');
    }
}
