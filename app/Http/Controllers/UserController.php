<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getLogin(){
        return view('admin.login');
    }


    public function postLogin(Request $request){
        $this->validate($request,
        [
            'email'=>'required|email',
            'password'=>'required|min:6|max:20'
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự'
        ]
        );
        $credentials=array('email'=>$request->email,'password'=>$request->password);
        if(Auth::attempt($credentials)){
            return redirect()->route('admin.index')->with(['flag'=>'success ','thongbao'=>'Đăng nhập thành công']);
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','thongbao'=>'Đăng nhập không thành công! sai mật khẩu hoặc tài khoản']);
        }
    }


    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.getLogin');
    }
    public function getUserEdit(string $id)
    {
        //
        $user =  User::find($id);
        return view('admin.modal.user_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function postUserEdit(Request $request, string $id)
    {
        //
        $this->validate($request, [
            
            'level' => 'required',
           
        ], [
                
                'level.required' => 'Bạn chưa nhập level',
               
            ]);
       
        $level = $request->level; 
       
       
        DB::table('users')->where('id', $id)->update([
            'level' =>   $level ,
            
           
        ]);
        
        return redirect(route('admin.getUserList'))->with('success','Cập nhật quyền hạn thành công!');
       
       
    }
    public function getUserDelete (string $id) {
        User::find($id)->delete();
        // $id->delete();
        return redirect()->back()->with('success','Xóa người dùng thành công');
    }
    
}
