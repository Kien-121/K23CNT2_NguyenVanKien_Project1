<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NVK_KHACH_HANG; 
class NVK_KHACH_HANGcontroller extends Controller
{
    //
    // CRUD
    // list
    public function nvkList()
    {
        $khachhangs = NVK_KHACH_HANG::all();
        return view('nvkAdmins.nvkkhachhang.nvk-list',['khachhangs'=>$khachhangs]);
    }
    // detail 
    public function nvkDetail($id)
    {
        $nvkkhachhang = NVK_KHACH_HANG::where('id',$id)->first();
        return view('nvkAdmins.nvkkhachhang.nvk-detail',['nvkkhachhang'=>$nvkkhachhang]);
    }
    // create
    public function nvkCreate()
    {
        return view('nvkAdmins.nvkkhachhang.nvk-create');
    }
    //post
    public function nvkCreateSubmit(Request $request)
    {
        $validate = $request->validate([
            'nvkMaKhachHang' => 'required|unique:nvk_khach_hang,nvkMaKhachHang',
            'nvkHoTenKhachHang' => 'required|string',
            'nvkEmail' => 'required|email|unique:nvk_khach_hang,nvkEmail',  
            'nvkMatKhau' => 'required|min:6',
            'nvkDienThoai' => 'required|numeric|unique:nvk_khach_hang,nvkDienThoai',  
            'nvkDiaChi' => 'required|string',
            'nvkNgayDangKy' => 'required|date',  
            'nvkTrangThai' => 'required|in:0,1,2',
        ]);

        $nvkkhachhang = new NVK_KHACH_HANG;
        $nvkkhachhang->nvkMaKhachHang = $request->nvkMaKhachHang;
        $nvkkhachhang->nvkHoTenKhachHang = $request->nvkHoTenKhachHang;
        $nvkkhachhang->nvkEmail = $request->nvkEmail;
        $nvkkhachhang->nvkMatKhau = $request->nhtMatKhau;
        $nvkkhachhang->nvkDienThoai = $request->nvkDienThoai;
        $nvkkhachhang->nvkDiaChi = $request->nvkDiaChi;
        $nvkkhachhang->nvkNgayDangKy = $request->nvkNgayDangKy;
        $nvkkhachhang->nvkTrangThai = $request->nvkTrangThai;

        $nvkkhachhang->save();

        return redirect()->route('nvkadmins.nvkkhachhang');


    }

    // edit
    public function nvkEdit($id)
    {
        // Lấy khách hàng theo id
        $nvkkhachhang = NVK_KHACH_HANG::where('id', $id)->first();
    
        // Kiểm tra nếu khách hàng không tồn tại
        if (!$nvkkhachhang) {
            return redirect()->route('nvkadmins.nvkkhachhang')->with('error', 'Khách hàng không tồn tại!');
        }
    
        // Trả về view để chỉnh sửa khách hàng
        return view('nvkAdmins.nvkkhachhang.nvk-edit', ['nvkkhachhang' => $nvkkhachhang]);
    }
    
    public function nvkEditSubmit(Request $request, $id)
    {
        // Xác thực dữ liệu
        $validate = $request->validate([
            'nvkMaKhachHang' => 'required|unique:nvk_khach_hang,nvkMaKhachHang,' . $id, // Bỏ qua kiểm tra unique cho bản ghi hiện tại
            'nvkHoTenKhachHang' => 'required|string',
            'nvkEmail' => 'required|email|unique:nvk_khach_hang,nvkEmail,' . $id,  // Bỏ qua kiểm tra unique cho bản ghi hiện tại
            'nvkMatKhau' => 'nullable|min:6', // Mật khẩu không bắt buộc khi cập nhật
            'nvkDienThoai' => 'required|numeric|unique:nvk_khach_hang,nvkDienThoai,' . $id,  // Bỏ qua kiểm tra unique cho bản ghi hiện tại
            'nvkDiaChi' => 'required|string',
            'nvkNgayDangKy' => 'required|date',
            'nvkTrangThai' => 'required|in:0,1,2',
        ]);
    
        // Lấy khách hàng theo id
        $nvkkhachhang = NVK_KHACH_HANG::where('id', $id)->first();
    
        // Kiểm tra nếu khách hàng không tồn tại
        if (!$nvkkhachhang) {
            return redirect()->route('nvkadmins.nvkkhachhang')->with('error', 'Khách hàng không tồn tại!');
        }
    
        // Cập nhật các giá trị từ request
        $nvkkhachhang->nvkMaKhachHang = $request->nvkMaKhachHang;
        $nvkkhachhang->nvkHoTenKhachHang = $request->nvkHoTenKhachHang;
        $nvkkhachhang->nvkEmail = $request->nvkEmail;
        $nvkkhachhang->nvkMatKhau = $request->nvkMatKhau;
        $nvkkhachhang->nvkDienThoai = $request->nvkDienThoai;
        $nvkkhachhang->nvkDiaChi = $request->nvkDiaChi;
        $nvkkhachhang->nvkNgayDangKy = $request->nvkNgayDangKy;
        $nvkkhachhang->nvkTrangThai = $request->nvkTrangThai;
    
        // Lưu khách hàng đã cập nhật
        $nvkkhachhang->save();
    
        // Chuyển hướng đến danh sách khách hàng
        return redirect()->route('nvkadmins.nvkkhachhang')->with('success', 'Cập nhật khách hàng thành công!');
    }
    
    //delete
    public function nvkDelete($id)
    {
        NVK_KHACH_HANG::where('id',$id)->delete();
        return back()->with('khachhang_deleted','Đã xóa Khách hàng thành công!');
    }

}