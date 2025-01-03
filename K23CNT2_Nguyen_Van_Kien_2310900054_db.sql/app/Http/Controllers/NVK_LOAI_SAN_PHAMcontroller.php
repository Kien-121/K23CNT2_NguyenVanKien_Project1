<?php

namespace App\Http\Controllers;

use App\Models\NVK_LOAI_SAN_PHAM;
use Illuminate\Http\Request;

class NVK_LOAI_SAN_PHAMcontroller extends Controller
{
    // Admins : CRUD

    // List
    public function nvkList()
    {
        $nvkLoaiSanPhams = nvk_loai_san_pham::all();
        return view('nvkAdmins.nvkLoaiSanPham.List', ['nvkLoaiSanPham' => $nvkLoaiSanPhams]);
    }

    //create
    public function nvkCreate()
    {
        return view('nvkAdmins.nvkLoaiSanPham.Create');
    }

    //create submit
    public function nvkCreateSubmit(Request $request)
    {
        //validation data
        $validatedData = $request->validate([
            'nvkMaLoai' => 'required|unique:nvk_loai_san_pham,nvkMaLoai',  // Kiểm tra mã loại không trống và duy nhất
            'nvkTenLoai' => 'required|string|max:255',  // Kiểm tra tên loại không trống và là chuỗi
            'nvkTrangThai' => 'required|in:0,1',  // Trạng thái phải là 0 hoặc 1
        ]);

        //ghi dữ liệu xuống DB
        $nvkLoaiSanPham = new nvk_loai_san_pham;
        $nvkLoaiSanPham->nvkMaLoai = $request->nvkMaLoai;
        $nvkLoaiSanPham->nvkTenLoai = $request->nvkTenLoai;
        $nvkLoaiSanPham->nvkTrangThai = $request->nvkTrangThai;

        $nvkLoaiSanPham->save();

        return redirect()->route('nvkadmins.nvkloaisanpham');
    }

    //edit
    public function nvkEdit($id)
    {
        $nvkLoaiSanPham = nvk_loai_san_pham::find($id);
        return view('nvkAdmins.nvkLoaiSanPham.Edit',['nvkLoaiSanPham'=>$nvkLoaiSanPham]);
    }

    //post edit submit
    public function nvkEditSubmit(Request $request)
    {

        $validatedData = $request->validate([
            'nvkMaLoai' => 'required|string|max:255|unique:nvk_loai_san_pham,nvkMaLoai,' . $request->id,  // Bỏ qua nvkMaLoai của bản ghi hiện tại
            'nvkTenLoai' => 'required|string|max:255',   
            'nvkTrangThai' => 'required|in:0,1',  // Validation for nvkTrangThai (0 or 1)
        ]);
    
        //ghi dữ liệu xuống DB
        $nvkLoaiSanPham = nvk_loai_san_pham::find($request->id);

        $nvkLoaiSanPham->nvkMaLoai = $request->nvkMaLoai;
        $nvkLoaiSanPham->nvkTenLoai = $request->nvkTenLoai;
        $nvkLoaiSanPham->nvkTrangThai = $request->nvkTrangThai;

        $nvkLoaiSanPham->save();

        return redirect()->route('nvkadmins.nvkloaisanpham');
    }

    //view
    public function nvkView($id)
    {
        // Tìm loại sản phẩm theo ID
        $nvkLoaiSanPham = nvk_loai_san_pham::findOrFail($id);
    
        return view('nvkAdmins.nvkLoaiSanPham.View', ['nvkLoaiSanPham' => $nvkLoaiSanPham]);
    }

    public function nvkDelete($id)
    {
        $nvkLoaiSanPham = nvk_loai_san_pham::find($id);
        $nvkLoaiSanPham->delete();
        return redirect()->route('nvkadmins.nvkloaisanpham','Đã xóa sinh viên thành công!');
    }

}