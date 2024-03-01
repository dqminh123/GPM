<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\khachhang;
use App\Models\comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use File;
use Mail;
use Validator;
use Illuminate\Support\Facades\Hash;


class ajax_controller extends Controller
{
    public function dangnhap(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'email' => 'required|exists:khachhang|email',
            'password' => 'required',
        ],
        [
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không đúng định dạng',
            'email.exists' => 'Email không tồn tại trong hệ thống',
            'password.required' => 'Password không được trống',
        ]);
        if($validator->passes())
        {
            $data=$request->only('email','password');
            $check_login= Auth::guard('khachhang')->attempt($data);
            if ($check_login){
                if (Auth::guard('khachhang')->user()->status == 0) {
                    Auth::guard('khachhang')->logout();
                    return response()->json(['error'=>['Tài khoản của bạn chưa xác thực']]);
                }
                return response()->json(['data'=>Auth::guard('khachhang')->user()]);
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);

        
    }

    public function comment(Request $request , $sanpham_id)
    {
        $khachhang_id = Auth::guard('khachhang')->user()->id;
        $validator = Validator::make($request->all(), [
            
            'content' => 'required',
            
        ],
        [
            'content.required' => 'Nội dung bình luận không được bỏ trống',
            
        ]);
        if($validator->passes())
        {
            $data=[
                'khachhang_id' =>$khachhang_id,
                'sanpham_id' => $sanpham_id,
                'content' => $request->content,
                'reply_id' => $request->reply_id ?  $request->reply_id : 0 ,
            ];
            if($comment=Comment::create($data))
            {
                // return response()->json(['data'=>$comment]);
                $comments = Comment::where(['sanpham_id'=>$sanpham_id,'reply_id'=>0])->orderBy('id','DESC')->get();
                return view('list_comment',compact('comments'));
            }
        }
        return response()->json(['error'=>$validator->errors()->first()]);
    }
}
