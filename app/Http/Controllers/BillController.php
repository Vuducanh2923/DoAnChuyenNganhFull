<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    //
    public function getBillEdit(string $id) {
        // Lấy thông tin bill và billDetail kèm theo product
    $bill = Bill::with(['billDetail.product', 'customer'])->find($id);

    // Kiểm tra nếu không tìm thấy bill
    if (!$bill) {
        return redirect()->route('admin.getBillList')->with('error', 'Đơn hàng không tồn tại');
    }

    return view('admin.modal.bill_edit', compact('bill'));
}
   
   public function postBillEdit(Request $request, string $id) {
       $this->validate($request, [
           
           'status' => 'required',
          
       ], [
               
               'status.required' => 'Bạn chưa nhập status',
              
           ]);
      
       $status = $request->status; 
      
      
       DB::table('bills')->where('id', $id)->update([
           'status' =>   $status ,
           
          
       ]);
       
       return redirect(route('admin.getBillList'))->with('success','Cập nhật đơn hàng thành công!');
      
      
       // return redirect()->back()->with('success','Sửa danh mục thành công');
   }

//
   public function getBillDelete( string $id)
   {
       //
       Bill::find($id)->delete();
       // $id->delete();
       return redirect()->back()->with('success','Xóa xóa đơn hàng thành công');
   }
}
