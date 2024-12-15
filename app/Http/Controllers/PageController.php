<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Mail\SendMail;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Email;
use App\Models\Favourite;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function getinputEmail() {
        return view('emails.input-email');
    }
    public function postinputEmail(Request $req) {
        $email=$req->email;
        //validate

        // kiểm tra có user có email như vậy không
        $user=User::where('email',$email)->get();
        // dd($user);
        if($user->count()!=0){
            // gửi mật khẩu reset tới email
            $matkhaumoi = substr( md5( rand (0,999999)), 0, 8); 
            $sentData = [
                'title' => 'Mật khẩu mới của bạn là:',
                'body' => $matkhaumoi,
            ];
            DB::table('users')->where('email',$email)->update([
                'password' =>   Hash::make($matkhaumoi) ,
                
               
            ]);
            Mail::to($req->user())->cc($email)->bcc($email)->send(new SendMail($sentData));
            Session::flash('message', 'Send email successfully!');

            return redirect()->route('getinputEmail'); //về lại trang đăng nhập của khách
        }
        else {
              return redirect()->route('getinputEmail')->with('message','email không tồn tại');
        }
    }//hết postInputEmail

    
    public function index(){
        
        $new_products =Product::where('new','=','1')->get();
        $Discountproducts = Product::where('promotion_price','!=','0')->get();
        $products = Product::orderBy('created_at', 'DESC')->search()->paginate(12);
        return view('index',compact('Discountproducts','products','new_products'));

    }
    public function product(string $id){
        $product = Product::find($id); //1.b
        $related = Product::where('id_type','=', $product->id_type)->inRandomOrder()->limit('3')->get();
        return view('product',array('product' => $product,'related'=>$related));
    }
    public function getCheckout(){
        return view('checkout');
    }
    public function postCheckout(Request $request){
       
        $cart=Session::get('cart');
        $customer=new Customer();
        $customer->name=$request->input('name');
        $customer->gender=$request->input('gender');
        $customer->email=$request->input('email');
        $customer->address=$request->input('address');
        $customer->phone_number=$request->input('phone_number');
        $customer->note = $request->input('note') ?? null;
        $customer->save();

        $bill=new Bill();
        $bill->id_customer=$customer->id;
        $bill->date_order=date('Y-m-d');
        $bill->total=$cart->totalPrice;
        $bill->payment=$request->input('payment_method');
        $bill->note=$request->input('note');
        $bill->status = 0;
        $bill->save();

        foreach($cart->items as $key=>$value)
        {
            $bill_detail=new BillDetail();
            $bill_detail->id_bill=$bill->id;
            $bill_detail->id_product=$key;
            $bill_detail->quantity=$value['qty'];
            $bill_detail->unit_price=$value['price']/$value['qty'];
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('success','Đặt hàng thành công');
    }
    public function shopping_cart(){
        return view('shopping_cart');
    }
    public function login(){
        return view('login');
    }
    public function signup(){
        return view('signup');
    }
    public function products(){
        $new_products =Product::where('new','=','1')->search()->get();

        $products = Product::orderBy('created_at', 'DESC')->search()->paginate(3);
        return view('products',compact('products','new_products'));
    }
    
    ///bill
    public function bill() {
        $bills = Bill::all();
        return view('admin.bill_admin', compact('bills'));
    }
    /////dang nhap
    public function getSignin()
    {
        //
        return view('signup');
    }
    public function postSignin(Request $req){
        $this->validate($req,
        ['email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:20',
            'full_name'=>'required',
            'repassword'=>'required|same:password'
        ],
        ['email.required'=>'Vui lòng nhập email',
        'email.email'=>'Không đúng định dạng email',
        'email.unique'=>'Email đã có người sử  dụng',
        'password.required'=>'Vui lòng nhập mật khẩu',
        'repassword.same'=>'Mật khẩu không giống nhau',
        'password.min'=>'Mật khẩu ít nhất 6 ký tự'
        ]);

        $user=new User();
        $user->full_name=$req->full_name;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->phone=$req->phone;
        $user->address=$req->address;
        $user->level=3;  //level=1: admin; level=2:kỹ thuật; level=3: khách hàng
        $user->save();
        return redirect()->back()->with('success','Tạo tài khoản thành công');
     }
     ///yeu thich
     public function addToFavourite(Request $request,$id){
        $product=Product::find($id);
        $oldFavourite=Session('favourite')?Session::get('favourite'):null;
        $favourite=new Favourite($oldFavourite);
        $favourite->add($product,$id);
        $request->session()->put('favourite',$favourite);
        return redirect()->back();
    }
  
    public function delFavouriteItem($id){
        $oldFavourite=Session::has('favourite')?Session::get('favourite'):null;
        $favourite=new Favourite($oldFavourite);
        $favourite->removeItem($id);
        if(count($favourite->items)>0){
            Session::put('favourite',$favourite);
        }else Session::forget('favourite');
        return redirect()->back();
    }

    /////// cart
    
    public function delCartItem($id){
        $oldCart=Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }else Session::forget('cart');
        return redirect()->back();
    }
    public function addToCart(Request $request,$id){
        $product=Product::find($id);
        $oldCart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->add($product,$id);
        $request->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function addManyToCart(Request $request,$id){
        $product=Product::find($id);
        $oldCart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->addMany($product,$id,$request->qty);
        $request->session()->put('cart',$cart);
       
        return redirect()->back();
    }
    public function SaveItemListCart(Request $request,$id,$quanty){
        
        $oldCart=Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->UpdateItemCart($id, $quanty);
        $request->session()->put('cart',$cart);
       
        // return redirect()->back();
    }
    public function SaveAllListItemCart(Request $request){
        foreach($request->data as $item){
            $oldCart=Session::has('cart')?Session::get('cart'):null;
            $cart=new Cart($oldCart);
            $cart->UpdateItemCart($item["key"],$item["value"]);
            $request->session()->put('cart',$cart);

        }
        ;
        // return redirect()->back();
    }
    public function IndexAdmin(){
        $products = Product::all();
        $users = User::all();
        $bills = Bill::where('status' ,'=','0')->get();
        $customer = Customer::all();
        return view('admin.index', compact('products', 'users', 'bills', 'customer'));
    }
    public function getlienhe()
    {
        return view('lienhe');
    // }
    // public function postlienhe(Request $request)
    // {
    //     $name = $request->input('name');
    //     $email = $request->input('email');
    //     $content = $request->input('message');
    //     $subject = $request->input('subject');

    //     // // Tạo một đối tượng UserMail với dữ liệu trên
    //     // $userMail = new ContactMail($name, $email, $content, $subject);

    //     // // Gửi email đến người quản lý web với địa chỉ là admin@web.com
    //     // Mail::to('vuducanh2923@gmail.com')->send($userMail);
    //     // $emails = new Email();
    //     // $emails->name = $name;
    //     // $emails->subject = $subject;
    //     // $emails->message = $content;
    //     // $emails->email = $email;
    //     // $emails->status = 1;
        
    //     // $emails->save();
    //     // Session::flash('message', 'Gửi email thành công !');
    //     // // Trả về một thông báo thành công
    //     // return redirect()->route('getlienhe');
    // }

    }
}
