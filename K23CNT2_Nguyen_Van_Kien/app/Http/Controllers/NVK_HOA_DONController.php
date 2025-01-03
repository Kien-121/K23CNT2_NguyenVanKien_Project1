<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NVK_HOA_DON; 
use App\Models\NVK_KHACH_HANG; 
use App\Models\NVK_SAN_PHAM; 
class NVK_HOA_DONController extends Controller
{
    //
    public function show($hoaDonId,$sanPhamId)
    {
        // Lấy hóa đơn từ ID
        $hoaDon = NVK_HOA_DON::findOrFail($hoaDonId);
        $sanPham = NVK_SAN_PHAM::findOrFail($sanPhamId);

        // Trả về view để hiển thị thông tin hóa đơn
        return view('nvkuser.hoadonshow', compact('hoaDon','sanPham'));
    }


      //admin CRUD
    // list -----------------------------------------------------------------------------------------------------------------------------------------
    public function nvkList()
    {
        $nvkhoadons = NVK_HOA_DON::all();
        return view('nvkAdmins.nvkhoadon.nht-list',['nvkhoadons'=>$nvkhoadons]);
    }
    // detail -----------------------------------------------------------------------------------------------------------------------------------------
    public function nvkDetail($id)
    {
        // Tìm sản phẩm theo ID
        $nvkhoadon = NVK_HOA_DON::where('id', $id)->first();

        // Trả về view và truyền thông tin sản phẩm
        return view('nvkAdmins.nvkhoadon.nvk-detail', ['nvkhoadon' => $nvkhoadon]);
    }
    // create
    public function nvkCreate()
    {
        $nvkkhachhang = NVK_KHACH_HANG::all();
        return view('nvkAdmins.nvkhoadon.nvk-create',['nvkkhachhang'=>$nvkkhachhang]);
    }
    //post
    public function nvkCreateSubmit(Request $request)
    {
        // Xác thực dữ liệu yêu cầu dựa trên các quy tắc xác thực
        $validate = $request->validate([
            'nvkMaHoaDon' => 'required|unique:nvk_hoa_don,nvkMaHoaDon',
            'nvkMaKhachHang' => 'required|exists:nvk_khach_hang,id',
            'nvkNgayHoaDon' => 'required|date',  
            'nvkNgayNhan' => 'required|date',
            'nvkHoTenKhachHang' => 'required|string',  
            'nvkEmail' => 'required|email',
            'nvkDienThoai' => 'required|numeric',  
            'nvkDiaChi' => 'required|string',  
            'nvkTongGiaTri' => 'required|numeric',  // Đã thay đổi thành numeric (cho kiểu double)
            'nvkTrangThai' => 'required|in:0,1,2',
        ]);
    
        // Tạo một bản ghi hóa đơn mới
        $nvkhoadon = new NVK_HOA_DON;
    
        // Gán dữ liệu xác thực vào các thuộc tính của mô hình
        $nvkhoadon->nvkMaHoaDon = $request->nvkMaHoaDon;
        $nvkhoadon->nvkMaKhachHang = $request->nvkMaKhachHang;  // Giả sử đây là khóa ngoại
        $nvkhoadon->nvkHoTenKhachHang = $request->nvkHoTenKhachHang;
        $nvkhoadon->nvkEmail = $request->nvkEmail;
        $nvkhoadon->nvkDienThoai = $request->nvkDienThoai;
        $nvkhoadon->nvkDiaChi = $request->nvkDiaChi;
        
        // Lưu 'nvkTongGiaTri' dưới dạng float (hoặc double) để phù hợp với kiểu dữ liệu trong cơ sở dữ liệu
        $nvkhoadon->nvkTongGiaTri = (double) $request->nvkTongGiaTri; // Chuyển đổi sang double
        
        $nvkhoadon->nvkTrangThai = $request->nvkTrangThai;
    
        // Đảm bảo định dạng đúng cho các trường ngày
        $nvkhoadon->nvkNgayHoaDon = $request->nvkNgayHoaDon;
        $nvkhoadon->nvkNgayNhan = $request->nvkNgayNhan;
    
        // Lưu bản ghi mới vào cơ sở dữ liệu
        $nvkhoadon->save();
    
        // Chuyển hướng đến danh sách hóa đơn
        return redirect()->route('nvkadmins.nvkhoadon');
    }
    


    public function nvkEdit($id)
    {
        $nvkhoadon = NVK_HOA_DON::where('id', $id)->first();
        $nvkkhachhang = NVK_KHACH_HANG::all();
        return view('nvkAdmins.nvkhoadon.nvk-edit',['nvkkhachhang'=>$nvkkhachhang,'nvkhoadon'=>$nvkhoadon]);
    }
    //post
    public function nvkEditSubmit(Request $request,$id)
    {
        // Xác thực dữ liệu yêu cầu dựa trên các quy tắc xác thực
        $validate = $request->validate([
            'nvkMaHoaDon' => 'required|unique:nvk_hoa_don,nvkMaHoaDon,'. $id,
            'nvkMaKhachHang' => 'required|exists:nvk_khach_hang,id',
            'nvkNgayHoaDon' => 'required|date',  
            'nvkNgayNhan' => 'required|date',
            'nvkHoTenKhachHang' => 'required|string',  
            'nvkEmail' => 'required|email',
            'nvkDienThoai' => 'required|numeric',  
            'nvkDiaChi' => 'required|string',  
            'nvkTongGiaTri' => 'required|numeric', 
            'nvkTrangThai' => 'required|in:0,1,2',
        ]);
    
        $nvkhoadon = NVK_HOA_DON::where('id', $id)->first();
        // Gán dữ liệu xác thực vào các thuộc tính của mô hình
        $nvkhoadon->nvkMaHoaDon = $request->nvkMaHoaDon;
        $nvkhoadon->nvkMaKhachHang = $request->nvkMaKhachHang;  // Giả sử đây là khóa ngoại
        $nvkhoadon->nvkHoTenKhachHang = $request->nvkHoTenKhachHang;
        $nvkhoadon->nvkEmail = $request->nvkEmail;
        $nvkhoadon->nvkDienThoai = $request->nvkDienThoai;
        $nvkhoadon->nvkDiaChi = $request->nvkDiaChi;
        
        // Lưu 'nvkTongGiaTri' dưới dạng float (hoặc double) để phù hợp với kiểu dữ liệu trong cơ sở dữ liệu
        $nvkhoadon->nvkTongGiaTri = (double) $request->nvkTongGiaTri; // Chuyển đổi sang double
        
        $nvkhoadon->nvkTrangThai = $request->nvkTrangThai;
    
        // Đảm bảo định dạng đúng cho các trường ngày
        $nvkhoadon->nvkNgayHoaDon = $request->nvkNgayHoaDon;
        $nvkhoadon->nvkNgayNhan = $request->nvkNgayNhan;
    
        // Lưu bản ghi mới vào cơ sở dữ liệu
        $nvkhoadon->save();
    
        // Chuyển hướng đến danh sách hóa đơn
        return redirect()->route('nvkadmins.nvkhoadon');
    }
    
        //delete
        public function nvkDelete($id)
        {
            NVK_HOA_DON::where('id',$id)->delete();
            return back()->with('hoadon_deleted','Đã xóa Khách hàng thành công!');
        }
}