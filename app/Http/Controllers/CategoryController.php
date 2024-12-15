<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //
    public function getCateList() {
        $cates = Category::orderBy('created_at', 'DESC')->get();
        return view('admin.cate', compact('cates'));
    }
    //
    public function getCateAdd() {

        return view('admin.modal.cate_add');
    }
    public function postCateAdd(Request $request)
    {
        if ($request->hasfile('image')) {
            $this->validate($request, [
                'image' => 'mimes:jpg,png,gif,jpeg|max: 2048',
                'description' => 'required',
                'name' => 'required',
               
            ], [
                    'image.mimes' => 'Chỉ chấp nhận file hình ảnh',
                    'image.max' => 'Chỉ chấp nhận hình ảnh dưới 2Mb',
                    'description.required' => 'Bạn chưa nhập mô tả',
                    'name.required' => 'Bạn chưa nhập name',
                   
                ]);
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('source/image/product'); //project\public\images, public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/category
        } else {
            $this->validate($request, [
                'description' => 'required',
                'name' => 'required',
               
                'image' => 'required',
            ], [
                    'description.required' => 'Bạn chưa nhập mô tả',
                    'name.required' => 'Bạn chưa nhập name',
                   
                    'image.required' => 'Bạn chưa chọn hình ảnh',
                ]);
        }
        $category = new Category;
        $category->description = $request->description; 
        $category->name = $request->name;
        $category->image = $name;
       
        
       
        $category->save();
        return redirect()->back()->with('success','Thêm danh mục thành công');
    }
    //
    public function getCateEdit(string $id) {
         $cate =  Category::find($id);
        return view('admin.modal.cate_edit', compact('cate'));
    }
    
    public function postCateEdit(Request $request, string $id) {
        if ($request->hasfile('image')) {
            $this->validate($request, [
                'image' => 'mimes:jpg,png,gif,jpeg|max: 2048',
                'description' => 'required',
                'name' => 'required',
               
            ], [
                    'image.mimes' => 'Chỉ chấp nhận file hình ảnh',
                    'image.max' => 'Chỉ chấp nhận hình ảnh dưới 2Mb',
                    'description.required' => 'Bạn chưa nhập mô tả',
                    'name.required' => 'Bạn chưa nhập name',
                   
                ]);
            $file = $request->file('image');
            $imgname = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('source/image/product'); //project\public\images, public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $imgname); //lưu hình ảnh vào thư mục public/category
        } else {
            $this->validate($request, [
                'description' => 'required',
                'name' => 'required',
               
                'image' => 'required',
            ], [
                    'description.required' => 'Bạn chưa nhập mô tả',
                    'name.required' => 'Bạn chưa nhập name',
                   
                    'image.required' => 'Bạn chưa chọn hình ảnh',
                ]);
        }
       
        $description = $request->description; 
        $name = $request->name;
        $image = $imgname;
       
        DB::table('type_products')->where('id', $id)->update([
            'description' =>   $description ,
            'name' =>  $name,
           
            'image'=> $image,
           
        ]);
        
        return redirect(route('admin.getCateList'))->with('success','Cập nhật sản phẩm thành công!');
       
       
        // return redirect()->back()->with('success','Sửa danh mục thành công');
    }

//
    public function getCateDelete( string $id)
    {
        //
        Category::find($id)->delete();
        // $id->delete();
        return redirect()->back()->with('success','Xóa danh mục thành công');
    }
}
