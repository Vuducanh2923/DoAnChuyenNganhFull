<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    //
    public function getBannerList() {
        $banners = Slide::all();
        return view('admin.banner', compact('banners'));
    }

    public function getBannerAdd() {

        return view('admin.modal.banner_add');
    }
    public function postBannerAdd(Request $request)
    {
        if ($request->hasfile('image')) {
            $this->validate($request, [
                'image' => 'mimes:jpg,png,gif,jpeg',
               
                'link' => 'required',
               
            ], [
                    'image.mimes' => 'Chỉ chấp nhận file hình ảnh',
                   
                 
                    'link.required' => 'Bạn chưa nhập link',
                   
                ]);
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('source/image/slide'); //project\public\images, public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/Slide
        } else {
            $this->validate($request, [
               
                'link' => 'required',
               
                'image' => 'required',
            ], [
                    
                    'link.required' => 'Bạn chưa nhập link',
                   
                    'image.required' => 'Bạn chưa chọn hình ảnh',
                ]);
        }
        $slide = new Slide;
        $slide->link = $request->link; 
        
        $slide->image = $name;
       
        
       
        $slide->save();
        return redirect()->back()->with('success','Thêm danh mục thành công');
    }
    //
    public function getBannerEdit(string $id) {
         $Slide =  Slide::find($id);
        return view('admin.modal.banner_edit', compact('Slide'));
    }
    
    public function postBannerEdit(Request $request, string $id) {
        if ($request->hasfile('image')) {
            $this->validate($request, [
                'image' => 'mimes:jpg,png,gif,jpeg|max: 2048',
               
                'link' => 'required',
               
            ], [
                    'image.mimes' => 'Chỉ chấp nhận file hình ảnh',
                    'image.max' => 'Chỉ chấp nhận hình ảnh dưới 2Mb',
                    'description.required' => 'Bạn chưa nhập mô tả',
                    'name.required' => 'Bạn chưa nhập name',
                   
                ]);
            $file = $request->file('image');
            $imgname = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('source/image/slide'); //project\public\images, public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $imgname); //lưu hình ảnh vào thư mục public/Slide
        } else {
            $this->validate($request, [
             
                'link' => 'required',
               
                'image' => 'required',
            ], [
                   
                    'link.required' => 'Bạn chưa nhập link',
                   
                    'image.required' => 'Bạn chưa chọn hình ảnh',
                ]);
        }
       
        $link = $request->link; 
        
        $image = $imgname;
       
        DB::table('slide')->where('id', $id)->update([
            'link' =>   $link ,
         
           
            'image'=> $image,
           
        ]);
        
        return redirect(route('admin.getBannerList'))->with('success','Cập nhật sản phẩm thành công!');
       
       
        // return redirect()->back()->with('success','Sửa danh mục thành công');
    }

//
    public function getBannerDelete( string $id)
    {
        //
        Slide::find($id)->delete();
        // $id->delete();
        return redirect()->back()->with('success','Xóa danh mục thành công');
    }
}
