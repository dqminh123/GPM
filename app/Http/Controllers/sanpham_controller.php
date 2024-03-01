<?php

namespace App\Http\Controllers;

use App\Models\sanpham;
use App\Models\danhmuc;
use App\Models\nhacungcap;
use App\Models\xuatxu;
use App\Models\baohanh;
use Illuminate\Http\Request;
use File;
use Str;
use Illuminate\Support\Facades\Validator;


class sanpham_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $xx=xuatxu::all();
        $ncc=nhacungcap::all();
        $dm=danhmuc::all();
        $bh=baohanh::all();
        return view('admin.sanpham.index',compact('xx','dm','ncc','bh'));
    }
    public function ds() {
		$sp = sanpham::all();
		$output = '';
		if ($sp->count() > 0) {
			$output .= '<table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Danh mục</th>
                <th scope="col">Xuất xứ</th>
                <th scope="col">Nhà cung cấp</th>
                <th scope="col">Bảo hành</th>
                <th scope="col">Số lượng</th>
                <th scope="col">giảm giá</th>
                <th scope="col">giá nhập</th>
                <th scope="col">giá xuất</th>
                <th scope="col">Ảnh</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($sp as $emp) {
				$output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->tensp . '</td>
                <td>' . $emp->danhmuc->tendanhmuc . '</td>
                <td>' . $emp->xuatxu->tenxuatxu . '</td>
                <td>' . $emp->nhacungcap->nhacungcap . '</td>
                <td>' . $emp->baohanh->baohanh . '</td>
                <td>' . $emp->soluong . '</td>
                <td>' . $emp->giamgia . '</td>
                <td>' . $emp->gianhap . '</td>
                <td>' . $emp->giaxuat . '</td>
                <td><img src="/GPM/public/sanpham/' . $emp->anh . '" width="50px" height="50px" alt="Image" "></td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="editbtn btn btn-primary" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i>Sửa</a>
                </td>
                <td>
                <a href="#" id="' . $emp->id . '" class="deletebtn btn btn-danger" data-toggle="modal" data-target="#modal-dle"><i class="fa fa-trash"></i>Xóa</a>
              </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tensp'=>'required|max:100',
            'soluong'=>'required|numeric',
            'gianhap'=>'required|numeric',
            'giamgia'=>'required|numeric',
            'giaxuat'=>'required|numeric',
            'nhacungcap_id'=>'required|numeric',
            'baohanh_id'=>'required|numeric',
            'xuatxu_id'=>'required|numeric',
            'danhmuc_id'=>'required|numeric',
            
        ],
        [
            'tensp.required' => 'Tên sản phẩm không được bỏ trống',
            'soluong.required' => 'Số lượng không được bỏ trống',
            'gianhap.required' => 'Giá nhập không được bỏ trống',
            'giamgia.required' => 'Giảm giá không được bỏ trống',
            'giaxuat.required' => 'Giá xuất không được bỏ trống',
            'nhacungcap_id.required' => 'Nhà cung cấp không được bỏ trống',
            'baohanh_id.required' => 'Bảo hành không được bỏ trống',
            'xuatxu_id.required' => 'Xuất xứ không được bỏ trống',
            'danhmuc_id.required' => 'Danh mục không được bỏ trống',
            
           
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            
            if($request->has('file_uploads')){
                $file=$request->file_uploads;
                $ex=$request->file_uploads->extension();
                $tenhinh=time().'.'.$request->sanpham.'.'.$ex;
                $file->move(public_path('sanpham'), $tenhinh);
            }
            $request->merge(['anh'=>$tenhinh]);
            $pro= new sanpham;
            $pro->tensp=$request->tensp;
            $pro->slug=str::slug($pro->tensp);
            $pro->xuatxu_id=$request->xuatxu_id;
            $pro->danhmuc_id=$request->danhmuc_id;
            $pro->nhacungcap_id=$request->nhacungcap_id;
            $pro->baohanh_id=$request->baohanh_id;
            $pro->gianhap=$request->gianhap;
            $pro->giaxuat=$request->giaxuat;
            $pro->giamgia=$request->giamgia;
            $pro->soluong=$request->soluong;
            $pro->anh=$request->anh;
            $pro->list_anh=$request->list_anh;
            $pro->chitiet=$request->chitiet;
            $pro->moi=$request->moi;
            $pro->noibat=$request->noibat;
            
            if($pro->save()){
                return response()->json([
                    'code'=>200,
                    'mess' => 'Thêm thành công !',
                ]);
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function show(sanpham $sanpham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
		$sanpham = sanpham::find($id);
        return response()->json($sanpham);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tensp'=>'required|max:100',
            'soluong'=>'required|numeric',
            'gianhap'=>'required|numeric',
            'giamgia'=>'required|numeric',
            'giaxuat'=>'required|numeric',
            'nhacungcap_id'=>'required|numeric',
            'baohanh_id'=>'required|numeric',
            'xuatxu_id'=>'required|numeric',
            'danhmuc_id'=>'required|numeric',
            'file_uploads' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ],
        [
            'tensp.required' => 'Tên sản phẩm không được bỏ trống',
            'soluong.required' => 'Số lượng không được bỏ trống',
            'gianhap.required' => 'Giá nhập không được bỏ trống',
            'giamgia.required' => 'Giảm giá không được bỏ trống',
            'giaxuat.required' => 'Giá xuất không được bỏ trống',
            'nhacungcap_id.required' => 'Nhà cung cấp không được bỏ trống',
            'baohanh_id.required' => 'Bảo hành không được bỏ trống',
            'xuatxu_id.required' => 'Xuất xứ không được bỏ trống',
            'danhmuc_id.required' => 'Danh mục không được bỏ trống',
            
            'file_uploads.image'  => 'Vui lòng chọn tệp là hình ảnh',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        else
        {
            $pro=sanpham::find($request->emp_id);
            $pro->tensp=$request->tensp;
            $pro->slug=str::slug($pro->tensp);
            $pro->xuatxu_id=$request->xuatxu_id;
            $pro->danhmuc_id=$request->danhmuc_id;
            $pro->nhacungcap_id=$request->nhacungcap_id;
            $pro->baohanh_id=$request->baohanh_id;
            $pro->giamgia=$request->giamgia;
            $pro->gianhap=$request->gianhap;
            $pro->giaxuat=$request->giaxuat;
            $pro->soluong=$request->soluong;
           
            $pro->chitiet=$request->chitiet;
            $pro->moi=$request->moi;
            $pro->noibat=$request->noibat;
            if($request->has('avatar')){
                $file=$request->avatar;
                $ex=$request->avatar->extension();
                $tenhinh=time().'.'.$request->sanpham.'.'.$ex;
                $file->move(public_path('sanpham'), $tenhinh);
            
                File::delete('public/sanpham/'.$pro->anh);
                $request->merge(['anh'=>$tenhinh]);
                $pro->anh=$request->anh;
            }
            $pro->save();
            
            return response()->json([
                'code'=>200,
                'mess'=>'Cập nhật thành công.'
            ]);
            
        }
        
        
    }
    
        
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        $id = $request->id;
        $sp= sanpham::find($id);
        $duongdan = 'public/sanpham';
        File::delete($duongdan.'/'.$sp->anh);
        if(sanpham::find($id)->dathang_chitiet->count())
        {
            return response()->json([
                'code'=>404,
                'error'=>'Không thể xóa sản phẩm vì sản phẩm hiện đã có ở trong đơn hàng.'
            ]);
        }
        else
        {
            $sp->delete();
            return response()->json([
                'code'=>200,
                'mess'=>'Xóa thành công.'
            ]);
        }
    }
}
