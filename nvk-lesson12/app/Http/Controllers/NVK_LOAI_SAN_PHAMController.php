<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NVK_LOAI_SAN_PHAM;

class NVK_LOAI_SAN_PHAMController extends Controller
{
    //admin: CRUD

    // list
    public function nvklist()
    {
        $nvkLoaiSanPham = NVK_LOAI_SAN_PHAM::all();

        return view('nvkAdmins.nvkLoaiSanPham.nvklist',['nvkLoaiSanPham'=>$nvkLoaiSanPham]);
    }

    //create
    public function nvkCreate()
    {
        return view('nvkadmins.nvkloaisanpham.nvk-create');
    }

     //create-submit
    public function nvkCreateSubmit(Request $request)
    {
        $nvkLoaiSanPham = new NVK_LOAI_SAN_PHAM;
        $nvkLoaiSanPham ->nvkMaLoai = $request->nvkMaLoai;
        $nvkLoaiSanPham ->nvkTenLoai = $request->nvkTenLoai;
        $nvkLoaiSanPham ->nvkTranThai = $request->nvkTranThai; 
        $nvkLoaiSanPham->save();
        return Redirect()->route('nvkadmins.nvkloaisanpham');
    }
    //create edit
    public function nvkedit()
    {
        $nvkLoaiSanPham = NVK_LOAI_SAN_PHAM::find($id);
        return view('nvkadmins.nvkloaisanpham.nvkedit',['nvkLoaiSanPham'=>$nvkLoaiSanPham]);
    }

    //post
    public function nvkeditSubmit(Request $request)
    {
        $nvkLoaiSanPham = NVK_LOAI_SAN_PHAM::find($request->id);
        $nvkLoaiSanPham ->nvkMaLoai = $request->nvkMaLoai;
        $nvkLoaiSanPham ->nvkTenLoai = $request->nvkTenLoai;
        $nvkLoaiSanPham ->nvkTranThai = $request->nvkTranThai; 
        $nvkLoaiSanPham->save();
        return Redirect()->route('nvkadmins.nvkloaisanpham');
    }

    //get-nvkdelete
    public function nvkDelete($id){
        $nvkLoaiSanPham = NVK_LOAI_SAN_PHAM::find($id);
        $nvkLoaiSanPham->remove();
        return redirect()->route('nvkadmins.nvkloaisanpham');
    }
}



