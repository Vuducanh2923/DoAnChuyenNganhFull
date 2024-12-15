<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    //
    public function index() {
        $ctms = Customer::all();
        return view('admin.customer', compact('ctms'));
    }
    
    //
    public function getCustomerEdit(string $id) {
         $Customer =  Customer::find($id);
        return view('admin.modal.customer_edit', compact('Customer'));
    }
    
    public function postCustomerEdit(Request $request, string $id) {
        $this->validate($request, [
            
            'contact' => 'required',
           
        ], [
                
                'contact.required' => 'Bạn chưa nhập contact',
               
            ]);
       
        $contact = $request->contact; 
       
        DB::table('customer')->where('id', $id)->update([
            'contact' =>   $contact ,
            
           
        ]);
        
        return redirect(route('admin.getCustomerList'))->with('success','Cập nhật liên hệ thành công!');
       
       
        // return redirect()->back()->with('success','Sửa danh mục thành công');
    }

//
    public function getCustomerDelete( string $id)
    {
        //
        Customer::find($id)->delete();
        // $id->delete();
        return redirect()->back()->with('success','Xóa người dùng thành công');
    }
}
