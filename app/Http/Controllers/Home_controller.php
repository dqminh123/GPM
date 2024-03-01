<?php

namespace App\Http\Controllers;
use App\Models\danhmuc;
use App\Models\nhacungcap;
use App\Models\sanpham;
use App\Models\khachhang;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use File;
use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


class Home_controller extends Controller
{
    public function index()
    {
        $dm=danhmuc::where('trangthai',1)->orderBy('tendanhmuc','ASC')->get();
        $sp=sanpham::limit(6)->where('noibat',1)->orderBy('id','DESC')->get();
        $sanpham=sanpham::limit(6)->where('moi',1)->orderBy('id','DESC')->get();
        return view('Home',compact('sp','sanpham','dm'));
    }
    public function about()
    {
        return view('about');
    }
    public function spdv()
    {
        return view('spdv');
    }
    public function lienhe()
    {
        return view('lienhe');
    }
    public function shop()
    {
        $dm=danhmuc::where('trangthai',1)->orderBy('tendanhmuc','ASC')->get();
        $ncc=nhacungcap::all();
        $sanpham=sanpham::where('moi',1)->orderBy('id','DESC')->paginate(9);
        $sp=sanpham::limit(3)->where('noibat',1)->orderBy('id','DESC')->get();
        $giagiam=sanpham::where('giamgia','>',0)->where('moi',1)->get();
        return view('shop',compact('dm','sanpham','sp','ncc'));
    }
    public function view($slug , $id){
        $model =danhmuc::where('slug',$slug)->first();
        $dm=danhmuc::where('trangthai',1)->orderBy('tendanhmuc','ASC')->get();
        $ncc=nhacungcap::all();
        $spp = sanpham::find($id);
        $ratingAvg= Rating::where('sanpham_id',$id)->avg('rating_start');
        $sp =sanpham::where('slug',$slug)->first();
        $models =nhacungcap::where('slug',$slug)->first();
        $sanpham=sanpham::limit(4)->where('noibat',1)->orderBy('id','DESC')->get();
        if ($model) {
            return view('dmsp',['model'=>$model,'dm'=>$dm,'ncc'=>$ncc]);
        }elseif ($sp) {
            return view('show',['model'=>$sp,'dm'=>$dm],compact('sanpham','ratingAvg' , 'spp'));
        }
        elseif ($models) {
            return view('dmncc',['models'=>$models,'ncc'=>$ncc,'dm'=>$dm]);
        }elseif ($sp) {
            return view('show',['models'=>$sp,'ncc'=>$ncc],compact('sanpham'));
        }


        else{
            return abort(404);
        }
       
    }

    

    public function views($slug , $id){
        $model =danhmuc::where('slug',$slug)->first();
        $dm=danhmuc::all();
        $ncc=nhacungcap::all();
        $spp = sanpham::find($id);
        $ratingAvg= Rating::where('sanpham_id',$id)->avg('rating_start');
        $sp =sanpham::where('slug',$slug)->first();
        $models =nhacungcap::where('slug',$slug)->first();
        $sanpham=sanpham::limit(6)->where('noibat',1)->orderBy('id','DESC')->get();
        if ($model) {
            return view('dmsp',['model'=>$model,'dm'=>$dm,'ncc'=>$ncc]);
        }elseif ($sp) {
            return view('show',['model'=>$sp,'dm'=>$dm],compact('sanpham'));
        }
        elseif ($models) {
            return view('dmncc',['models'=>$models,'ncc'=>$ncc,'dm'=>$dm]);
        }elseif ($sp) {
            return view('show',['models'=>$sp,'ncc'=>$ncc],compact('sanpham' , 'ratingAvg' , 'spp'));
        }


        else{
            return abort(404);
        }
       
    }

    
    
    public function dangxuat(){
        Auth::guard('khachhang')->logout();
        
        return redirect()->route('Home.index');
   
     }
    public function postdangnhap(Request $request)
    {
        $messages = [
            'email.required' => 'Email không được bỏ trống',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'email.email' => 'Email không đúng định dạng',
        ];
        $request->validate([
            'password' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
        ],$messages);

        $data=$request->only('email','password');
        $check_login= Auth::guard('khachhang')->attempt($data);
        if ($check_login){
            if (Auth::guard('khachhang')->user()->status == 0) {
                Auth::guard('khachhang')->logout();
                return redirect()->route('Home.dangnhap')->with('no','Tài khoản chưa được kích hoạt, Vui lòng nhấn vào <a href="'.route('Home.get_active').'">đây để có thể tiến hành kích hoạt tài khoản</a>');
            }
            return redirect()->route('Home.index');
        }else
        {
            return redirect()->route('Home.dangnhap')->with('no','Email hoặc mật khẩu sai');
        }
        
    }

        public function postdangky(Request $request){
            $messages = [
            'hovaten.required' => 'Họ và tên không được bỏ trống',
            'diachi.required' => 'Địa chỉ không được bỏ trống',
            'dienthoai.required' => 'Số điện thoại không được bỏ trống',
            'dienthoai.max' => 'Số điện thoại không được vượt quá 10 ký tự',
            'tendangnhap.required' => 'Tên đăng nhập không được bỏ trống',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'email.required' => 'Email không được bỏ trống',
            'file_uploads.required'  => 'Ảnh không được bỏ trống',
            'file_uploads.image'  => 'Vui lòng chọn tệp là hình ảnh',
            'password_m.required' => 'Xác nhận mật khẩu không được bỏ trống',
            'password_m.same'=>'Xác nhận mật khẩu sai ',
            'email.email' => 'Email không đúng định dạng',
            
        ];

        $request->validate([
            'hovaten' => 'required|string|max:255',
            'diachi' => 'required|string|max:255',
            'dienthoai' => 'required|numeric',
            'tendangnhap' => 'required|string|max:255|unique:khachhang',
            'password' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:khachhang|email',
            'file_uploads' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password_m'=>'required|same:password',
            
        ],$messages);
        if($request->has('file_uploads')){
            $file=$request->file_uploads;
            $ex=$request->file_uploads->extension();
            $tenhinh=time().'.'.$request->khachhang.'.'.$ex;
            $file->move(public_path('khachhang'), $tenhinh);
        }
        $request->merge(['anh'=>$tenhinh]);
        
        $token=strtoupper(Str::random(10));
        $kh=$request->only('hovaten','gioitinh','diachi','dienthoai','email','tendangnhap','password','anh');
        $password_m =bcrypt($request->password);
        $kh['password'] = $password_m;
        $kh['token'] =$token;
        $kh['status']=0;
    
        if($khachhang=khachhang::create($kh)){
            Mail::send('gmail.active_account',compact('khachhang'), function($email) use($khachhang){
                $email->subject('GPM - Xác nhận tài khoản');
                $email->to($khachhang->email,$khachhang->hovaten); 

            });
            return redirect()->route('Home.dangnhap')->with('yes','Đăng ký tài khoản thành công, Vui lòng vào gmail kích hoạt tài khoản để có thể sử dụng');
            
        }
                return redirect()->back();
    }

    public function changepassword()
    {
        return view('khachhang.changepassword');
    }

    public function update_password(Request $request)
    {
        $messages = [
            'password_m.required' => 'Mật khẩu mới không được bỏ trống',
            'password_xn.required' => 'Xác nhận mật khẩu không được bỏ trống',
            'password_xn.same'=>'Xác nhận mật khẩu sai ',
            'password_c.required' => 'Mật khẩu cũ không được bỏ trống',
        ];

        $request->validate([
            'password_m'=>'required|string|max:255',
            'password_c' => 'required|string|max:255',
            'password_xn'=>'required|same:password_m',
        ],$messages);

        $id=Auth::guard('khachhang')->user()->id;
        $khachhang=khachhang::find($id);

        if (Hash::check($request->password_c,$khachhang->password)) {
            $khachhang->password= bcrypt($request->password_m);
            $khachhang->save();

            return redirect()->back()->with('yes','Đổi mật khẩu thành công');
        }
        else{
            return redirect()->back()->with('no','Mật khẩu cũ không đúng');
        }
    }
    public function account()
    {     
        return view('khachhang.account');
    }
    public function update_account(Request $request)
         {
           
            $id=Auth::guard('khachhang')->user()->id;
            $messages = [
                'hovaten.required' => 'Họ và tên không được bỏ trống',
                'diachi.required' => 'Địa chỉ không được bỏ trống',
                'dienthoai.required' => 'Số điện thoại không được bỏ trống',
                'dienthoai.max' => 'Số điện thoại không được vượt quá 10 ký tự',
                
                'email.required' => 'Email không được bỏ trống',
                'file_uploads.image'  => 'Vui lòng chọn tệp là hình ảnh',
                'email.email' => 'Email không đúng định dạng',
                
            ];
    
            $request->validate([
                'hovaten' => 'required|string|max:255',
                'diachi' => 'required|string|max:255',
                'dienthoai' => 'required|numeric',
                
                'email' => 'required|string|max:255|email',
                'file_uploads' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                
                
            ],$messages);
           
            if($request->has('file_uploads')){
                $file=$request->file_uploads;
                $ex=$request->file_uploads->extension();
                $tenhinh=time().'.'.$request->khachhang.'.'.$ex;
                $file->move(public_path('khachhang'), $tenhinh);
                File::delete('public/khachhang/'.$kh->anh);
                $request->merge(['anh'=>$tenhinh]);
                
            }
            
            $token=strtoupper(Str::random(10));
            $kh=$request->only('hovaten','gioitinh','diachi','dienthoai','email','anh');
            $kh['token'] =$token;
            if($khachhang=khachhang::find($id)->update($kh)){  
                return redirect()->route('khachhang.account')->with('yes','Cập nhật thông tin thành công');  
            }
                    return redirect()->back()->with('no','Cập nhật thông tin không thành công'); 
         }
         public function change_account()
         {
             $kh= Auth::guard('khachhang')->user();
             return view('khachhang.change_account',compact('kh'));
         }
         public function get_active()
        {
            return view('get_active');
        }
        public function postget_active(Request $request)
        {
            $messages = [
                'email.required' => 'Email không được bỏ trống',
                'email.exists' => 'Email không tồn tại trong hệ thống',
                
            ];
    
            $request->validate([
                'email'=>'required|exists:khachhang',
                
            ],$messages);

            $token=strtoupper(Str::random(10));
            $khachhang = khachhang::where('email',$request->email)->first();
            $khachhang->update(['token'=>$token]);
            
                Mail::send('gmail.active_account',compact('khachhang'), function($email) use($khachhang){
                    $email->subject('GPM - Xác nhận tài khoản');
                    $email->to($khachhang->email,$khachhang->hovaten); 
                  
                });
                return redirect()->back()->with('yes','Vui lòng check email để thực hiện kích hoạt tài khoản');
        }
        public function forget_password()
        {
            return view('forget_password');
        }
        public function postforget_password(Request $request)
        {
            $messages = [
                'email.required' => 'Email không được bỏ trống',
                'email.exists' => 'Email không tồn tại trong hệ thống',
                
            ];
    
            $request->validate([
                'email'=>'required|exists:khachhang',
                
            ],$messages);

            $token=strtoupper(Str::random(10));
            $khachhang = khachhang::where('email',$request->email)->first();
            $khachhang->update(['token'=>$token]);
            
                Mail::send('gmail.check_forget',compact('khachhang'), function($email) use($khachhang){
                    $email->subject('GPM - Lấy lại mật khẩu tài khoản của bạn');
                    $email->to($khachhang->email,$khachhang->hovaten); 
                  
                });
                return redirect()->back()->with('yes','Vui lòng check email để thực hiện thay đổi mật khẩu');
            
            
        }
        public function get_password(khachhang $khachhang, $token)
        {
            if ($khachhang->token === $token) {
               return view('get_password');
            }
            return abort(404);
        }
        public function postget_password(khachhang $khachhang, $token, Request $request)
        {
            $messages = [
                'password.required' => 'Mật khẩu không được bỏ trống',
                'password_xn.same' => 'Xác nhận mật khẩu không đúng',
                'password_xn.required' => 'Xác nhận mật khẩu không được bỏ trống',
                
            ];
    
            $request->validate([
                'password'=>'required|max:255',
                'password_xn' => 'required|same:password',
                
            ],$messages);

            $password_m =bcrypt($request->password);
            $khachhang->update(['password' =>$password_m,'token'=>null]);
            return redirect()->route('Home.dangnhap')->with('yes','Đặt lại mật khẩu thành công, bây giờ bạn có thể đăng nhập');
        }
        public function dangnhap(){
            return view('dangnhap_kh');
      
         }
         public function dangky(){
            return view('dangky_kh');
    
    }
        public function rating(Request $request)
        {
            $model =Rating::where($request->only('sanpham_id','khachhang_id'))->first();
            if($model){
                Rating::where($request->only('sanpham_id','khachhang_id'))->update($request->only('rating_start'));
            }else{
                Rating::create($request->only('rating_start','sanpham_id','khachhang_id'));
            }
            
            return redirect()->back();
        }

        public function postshop(Request $request)
    {
        $dm=danhmuc::where('trangthai',1)->orderBy('tendanhmuc','ASC')->get();
        $ncc=nhacungcap::all();
        $sp=sanpham::limit(6)->where('noibat',1)->orderBy('id','DESC')->get();
        if($request->sapxep == 'popularity')
        {
            $sanpham = SanPham::leftJoin('dathang_chitiet', 'sanpham.id', '=', 'dathang_chitiet.sanpham_id')
            ->selectRaw('sanpham.*, coalesce(sum(dathang_chitiet.soluong), 0) tongsoluongban')
            ->groupBy('sanpham.id')
            ->orderBy('tongsoluongban', 'desc')
            ->paginate(16);
            session()->put('sapxep', 'popularity');
        }
        elseif($request->sapxep == 'date') // Mới nhất
        {
            $sanpham = SanPham::orderBy('moi', 'desc')->paginate(9);

            // Ghi vào SESSION
            session()->put('sapxep', 'date');
        }
        elseif($request->sapxep == 'price') // Xếp theo giá: thấp đến cao
        {
            $sanpham = SanPham::orderBy('giaxuat', 'asc')->paginate(9);

            // Ghi vào SESSION
            session()->put('sapxep', 'price');
        }
        elseif($request->sapxep == 'price-desc') // Xếp theo giá: cao xuống thấp
        {
            $sanpham = SanPham::orderBy('giaxuat', 'desc')->paginate(9);

            // Ghi vào SESSION
            session()->put('sapxep', 'price-desc');
        }
        else // Mặc định
        {
            $sanpham = SanPham::paginate(9);

            // Ghi vào SESSION
            session()->put('sapxep', 'default');
        }
        return view('shop',compact('dm','sanpham','ncc','sp'));

    }

    



}
