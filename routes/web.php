<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/','Home_controller@index')->name('Home.index');
Route::get('/gioi-thieu','Home_controller@about')->name('Home.about');
Route::get('/san-pham-dich-vu','Home_controller@spdv')->name('Home.spdv');
Route::get('/lien-he','Home_controller@lienhe')->name('Home.lienhe');
Route::get('/san-pham','Home_controller@shop')->name('Home.shop');
Route::post('/san-pham','Home_controller@postshop')->name('Home.shop');
Route::get('danh-muc/{slug}/{id}','Home_controller@view')->name('Home.view');
Route::get('nha-cung-cap/{slug}/{id}','Home_controller@views')->name('Home.views');



//
Route::get('/dangnhap_kh/index','Home_controller@dangnhap')->name('Home.dangnhap');
Route::get('/dangky_kh/index','Home_controller@dangky')->name('Home.dangky');
Route::post('/dangnhap_kh','Home_controller@postdangnhap')->name('Home.postdangnhap');
Route::post('/dangky_kh','Home_controller@postdangky')->name('Home.postdangky');
Route::get('/dangky_kh/active/{khachhang}/{token}','Home_controller@active')->name('Home.active');
Route::get('/dangky_kh/get_active','Home_controller@get_active')->name('Home.get_active');
Route::post('/dangky_kh/postget_active','Home_controller@postget_active');

Route::get('/forget_password','Home_controller@forget_password')->name('Home.forget_password');
Route::post('/forget_password','Home_controller@postforget_password');
Route::get('/get_password/{khachhang}/{token}','Home_controller@get_password')->name('Home.get_password');
Route::post('/get_password/{khachhang}/{token}','Home_controller@postget_password');
//
Route::group(['prefix'=>'khachhang','middleware'=>'kh_middleware'],function(){
    Route::get('/dangxuat','Home_controller@dangxuat')->name('khachhang.dangxuat');
    Route::get('/changepassword','Home_controller@changepassword')->name('khachhang.changepassword');
    Route::post('/update_password','Home_controller@update_password')->name('khachhang.update_password');
    Route::get('/account','Home_controller@account')->name('khachhang.account');
    Route::get('/change_account','Home_controller@change_account')->name('account.change_account');
    Route::post('/update_account','Home_controller@update_account')->name('account.update_account');
    Route::post('/rating','Home_controller@rating')->name('Home.rating');
});
//
Route::get('/dangxuat','ajax_controller@dangxuat')->name('ajax.dangxuat');
Route::post('/dangnhap','ajax_controller@dangnhap')->name('ajax.dangnhap');
Route::post('/comment/{sanpham_id}','ajax_controller@comment')->name('ajax.comment');
//
Route::get('admin/dangnhap', 'admin_controller@dangnhap')->name('admin.dangnhap');
Route::post('admin/dangnhap', 'admin_controller@postdangnhap')->name('admin.postdangnhap');
Route::get('admin/dangxuat', 'admin_controller@dangxuat')->name('admin.dangxuat');
Route::post('/chon_vanchuyenhome','giohang_controller@chonvanchuyenhome')->name('chon.vanchuyenhome');
Route::post('/tinhvanchuyen','giohang_controller@tinhvanchuyen')->name('tinh.vanchuyen');
Route::get('/xoa_vanchuyen','giohang_controller@xoachiphi')->name('xoachiphi.vanchuyen');
//
Route::group(['prefix'=>'giohang'], function () {
    Route::get('/themvaogio/{slug}','giohang_controller@themvaogio')->name('Home.themvaogio');
    Route::get('/','giohang_controller@view')->name('giohang.view');
    Route::get('/xoa/{row_id}','giohang_controller@xoa')->name('giohang.xoa');
    Route::get('/capnhattang/{row_id}','giohang_controller@capnhattang')->name('giohang.capnhattang');
    Route::get('/capnhatgiam/{row_id}','giohang_controller@capnhatgiam')->name('giohang.capnhatgiam');
    Route::get('/xoahet','giohang_controller@xoahet')->name('giohang.xoahet');
    
});
//
Route::group(['prefix'=>'dathang'], function () {
    Route::get('/','dathang_controller@index')->name('dathang.index');
    Route::post('/thanhtoan','dathang_controller@add')->name('dathang.add');
    Route::get('/thanhcong','dathang_controller@thanhcong')->name('dathang.thanhcong');
    Route::get('/myorder','dathang_controller@myorder')->name('dathang.myorder');
    Route::get('/myorder_detail/{id}','dathang_controller@myorder_detail')->name('dathang.myorder_detail');
   
});
//
Route::group(['prefix'=>'admin','middleware'=>'ad_middleware'], function () {
    Route::get('/','admin_controller@index')->name('admin.index');
    Route::get('/file','admin_controller@file')->name('admin.file');
    Route::get('/chucvu/ds','chucvu_controller@ds')->name('chucvu.ds');
    Route::get('/chucvu/ajax','chucvu_controller@ajax')->name('chucvu.ajax');
    Route::get('/chucvu/edit/{id}','chucvu_controller@edit')->name('chucvu.edit');
    Route::post('/chucvu/update/{id}','chucvu_controller@update')->name('chucvu.update');
    Route::post('/chucvu/destroy','chucvu_controller@destroy')->name('chucvu.destroy');
    //
    Route::post('/thanhpho/nhap_excel','thanhpho_controller@postnhap')->name('thanhpho.nhap');
    // Route::get('/tinh/xuat_excel','tinh_controller@getxuat')->name('tinh.xuat');

    Route::post('/huyen/nhap_excel','huyen_controller@postnhap')->name('huyen.nhap');
    Route::post('/chon_vanchuyen','phivanchuyen_controller@chon')->name('chon.phivanchuyen');
    Route::post('/them_vanchuyen','phivanchuyen_controller@them')->name('them.phivanchuyen');
   
    // Route::get('/huyen/xuat_excel','huyen_controller@getxuat')->name('huyen.xuat');
    Route::post('/xa/nhap_excel','xa_controller@postnhap')->name('xa.nhap');
    // Route::get('/xa/xuat_excel','xa_controller@getxuat')->name('xa.xuat');
    //
    Route::get('/xuatxu/ds','xuatxu_controller@ds')->name('xuatxu.ds');
    Route::get('/xuatxu/edit/{id}','xuatxu_controller@edit')->name('xuatxu.edit');
    Route::post('/xuatxu/update/{id}','xuatxu_controller@update')->name('xuatxu.update');
    Route::post('/xuatxu/destroy','xuatxu_controller@destroy')->name('xuatxu.destroy');
    //
    Route::get('/tinhtrang/ds','tinhtrang_controller@ds')->name('tinhtrang.ds');
    Route::get('/tinhtrang/edit/{id}','tinhtrang_controller@edit')->name('tinhtrang.edit');
    Route::post('/tinhtrang/update/{id}','tinhtrang_controller@update')->name('tinhtrang.update');
    Route::post('/tinhtrang/destroy','tinhtrang_controller@destroy')->name('tinhtrang.destroy');
    //
    Route::get('/nhacungcap/ds','nhacungcap_controller@ds')->name('nhacungcap.ds');
    Route::get('/nhacungcap/edit/{id}','nhacungcap_controller@edit')->name('nhacungcap.edit');
    Route::post('/nhacungcap/update/{id}','nhacungcap_controller@update')->name('nhacungcap.update');
    Route::post('/nhacungcap/destroy','nhacungcap_controller@destroy')->name('nhacungcap.destroy');
    //
    Route::get('/baohanh/ds','baohanh_controller@ds')->name('baohanh.ds');
    Route::get('/baohanh/edit/{id}','baohanh_controller@edit')->name('baohanh.edit');
    Route::post('/baohanh/update/{id}','baohanh_controller@update')->name('baohanh.update');
    Route::post('/baohanh/destroy','baohanh_controller@destroy')->name('baohanh.destroy');
    //
    Route::get('/danhmuc/ds','danhmuc_controller@ds')->name('danhmuc.ds');
    Route::get('/danhmuc/edit/{id}','danhmuc_controller@edit')->name('danhmuc.edit');
    Route::post('/danhmuc/update/{id}','danhmuc_controller@update')->name('danhmuc.update');
    Route::post('/danhmuc/destroy','danhmuc_controller@destroy')->name('danhmuc.destroy');
    //
    Route::get('/nhanvien/ds','nhanvien_controller@ds')->name('nhanvien.ds');
    Route::get('/nhanvien/edit/{id}','nhanvien_controller@edit')->name('nhanvien.edit');
    Route::post('/nhanvien/update/{id}','nhanvien_controller@update')->name('nhanvien.update');
    Route::post('/nhanvien/destroy','nhanvien_controller@destroy')->name('nhanvien.destroy');
    //
    Route::get('/khachhang/ds','khachhang_controller@ds')->name('khachhang.ds');
    Route::get('/khachhang/edit/{id}','khachhang_controller@edit')->name('khachhang.edit');
    Route::post('/khachhang/update/{id}','khachhang_controller@update')->name('khachhang.update');
    Route::post('/khachhang/destroy','khachhang_controller@destroy')->name('khachhang.destroy');
    //
    Route::get('/sanpham/ds','sanpham_controller@ds')->name('sanpham.ds');
    Route::get('/sanpham/edit','sanpham_controller@edit')->name('sanpham.edit');
    Route::post('/sanpham/update','sanpham_controller@update')->name('sanpham.update');
    Route::POST('/sanpham/destroy','sanpham_controller@destroy')->name('sanpham.destroy');
    //
    Route::get('/order', 'order_controller@index')->name('order.index');
    Route::get('/order/show/{id}', 'order_controller@show')->name('order.show');
    Route::get('/order/destroy/{id}', 'order_controller@destroy')->name('order.destroy');
    Route::get('/order/nhandon/{id}', 'order_controller@nhandon')->name('order.nhandon');
    Route::get('/order/tinhtrang/{id}/{tt}', 'order_controller@tinhtrang')->name('order.tinhtrang');
    //
    Route::resources([
        'chucvu' => 'chucvu_controller',
        'xuatxu' => 'xuatxu_controller',
        'danhmuc' => 'danhmuc_controller',
        'tinhtrang' => 'tinhtrang_controller',
        'nhacungcap' => 'nhacungcap_controller',
        'baohanh' => 'baohanh_controller',
        'nhanvien' => 'nhanvien_controller',
        'khachhang' => 'khachhang_controller',
        'sanpham' => 'sanpham_controller',
        'xa' => 'xa_controller',
        'huyen' => 'huyen_controller',
        'thanhpho' => 'thanhpho_controller',
        'phivanchuyen' => 'phivanchuyen_controller',

    ]);
        

    
});
