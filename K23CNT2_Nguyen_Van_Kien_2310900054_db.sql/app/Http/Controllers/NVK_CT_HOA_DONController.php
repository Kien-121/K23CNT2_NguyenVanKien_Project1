<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nvk_CT_HOA_DON; 
use App\Models\nvk_SAN_PHAM; 
use App\Models\nvk_HOA_DON; 
use App\Models\nvk_KHACH_HANG; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NVK_CT_HOA_DONController extends Controller
{
    //create hoadon user

  // Controller
public function show($sanPhamId)
{
    $sanPham = nvk_SAN_PHAM::find($sanPhamId);

    // Lấy Mã Khách Hàng từ session
    $userId = Session::get('nvkMaKhachHang');

    // Kiểm tra khách hàng tồn tại trong hệ thống
    $khachHang = nvk_KHACH_HANG::find($userId);

    // Truyền thông tin qua view
    return view('nvkuser.hoadon', [
        'sanPham' => $sanPham,
        'khachHang' => $khachHang, // Truyền thông tin khách hàng vào view
    ]);
}
  

  
  


   /**
    * Xử lý khi người dùng nhấn "Mua", tạo hóa đơn tự động.
    */
    public function store(Request $request)
    {
        // Lấy Mã Khách Hàng từ session
        $userId = Session::get('nvkMaKhachHang'); // Lấy ID khách hàng từ session
    
        // Kiểm tra nếu không có khách hàng trong session
        if (!$userId) {
            return redirect()->route('nvkuser.login')->with('error', 'Vui lòng đăng nhập để tiếp tục!');
        }
    
        // Kiểm tra khách hàng tồn tại trong bảng nht_KHACH_HANG
        $khachhang = nvk_KHACH_HANG::find($userId);
        if (!$khachhang) {
            return redirect()->route('nvkuser.login')->with('error', 'Khách hàng không tồn tại.');
        }
    
        // Lấy thông tin sản phẩm từ bảng nht_SAN_PHAM
        $sanPham = nvk_SAN_PHAM::find($request->nvkSanPhamId);
        if (!$sanPham) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }
    
        // Tạo mã hóa đơn tự động (nvkMaHoaDon)
        $nvkMaHoaDon = 'HD' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT); // Tạo mã hóa đơn ngẫu nhiên
    
        // Tạo hóa đơn mới với thông tin lấy từ khách hàng
        $hoaDon = nvk_HOA_DON::create([
            'nvkMaHoaDon' => $nvkMaHoaDon,
            'nvkMaKhachHang' => $khachhang->id,  // Sử dụng ID của khách hàng từ bảng nht_KHACH_HANG
            'nvkNgayHoaDon' => Carbon::now()->toDateString(),
            'nvkNgayNhan' => Carbon::now()->addDays(3)->toDateString(),
            'nvkHoTenKhachHang' => $request->nvkHoTenKhachHang,
            'nvkEmail' => $request->nvkEmail,
            'nvkDienThoai' => $request->nvkDienThoai,
            'nvkDiaChi' => $request->nvkDiaChi,
            'nvkTongGiaTri' => $sanPham->nvkDonGia * $request->nvkSoLuong, // Tính tổng giá trị
            'nvkTrangThai' => 0, // 0 nghĩa là chưa thanh toán
        ]);
     
        // Quay lại trang chi tiết hóa đơn vừa tạo
        return redirect()->route('hoadon.show', ['hoaDonId' => $hoaDon->id, 'sanPhamId' => $sanPham->id]);
    }
    
    
    

// xem cthoadon
public function create($hoaDonId, $sanPhamId)
{
    // Lấy thông tin hóa đơn và sản phẩm
    $hoaDon = nvk_HOA_DON::find($hoaDonId);
    $sanPham = nvk_SAN_PHAM::find($sanPhamId);

    // Kiểm tra nếu hóa đơn hoặc sản phẩm không tồn tại
    if (!$hoaDon || !$sanPham) {
        return redirect()->route('hoadon.index')->with('error', 'Hóa đơn hoặc sản phẩm không tồn tại.');
    }
 // Lấy số lượng từ request
 $soLuong = request('nvkSoLuong', 1); // Số lượng mặc định là 1 nếu không có giá trị
    // Truyền dữ liệu vào view
    return view('nvkuser.cthoadon', [
        'hoaDon' => $hoaDon,
        'sanPham' => $sanPham,
        'soLuong' => $soLuong // Truyền số lượng vào view
    ]);
}


public function cthoadonshow($hoaDonId, $sanPhamId)
{
    // Lấy hóa đơn từ ID
    $hoaDon = nvk_HOA_DON::findOrFail($hoaDonId);

    // Lấy chi tiết hóa đơn từ ID
    $chiTietHoaDon = nvk_CT_HOA_DON::where('nvkHoaDonID', $hoaDonId)
                                    ->where('nvkSanPhamID', $sanPhamId)
                                    ->firstOrFail();

    // Trả về view và truyền dữ liệu
    return view('nvkuser.cthoadonshow', compact('hoaDon', 'chiTietHoaDon'));
}





    public function storecthoadon(Request $request)
    {
        // Validate các dữ liệu yêu cầu
        $validated = $request->validate([
            'nvkSanPhamID' => 'required|exists:nvk_SAN_PHAM,id',
            'nvkHoaDonID' => 'required|exists:nvk_HOA_DON,id',
            'nvkSoLuong' => 'required|integer|min:1',
        ]);
    
        // Lấy thông tin sản phẩm và hóa đơn
        $sanPham = nvk_SAN_PHAM::find($request->nvkSanPhamID);
        $hoaDon = nvk_HOA_DON::find($request->nvkHoaDonID);
    
        // Kiểm tra xem sản phẩm và hóa đơn có tồn tại không
        if (!$sanPham || !$hoaDon) {
            return redirect()->back()->with('error', 'Sản phẩm hoặc hóa đơn không tồn tại.');
        }
    
        // Kiểm tra xem chi tiết hóa đơn đã tồn tại chưa
        $chiTietHoaDon = nvk_CT_HOA_DON::where('nvkHoaDonID', $hoaDon->id)
                                        ->where('nvkSanPhamID', $sanPham->id)
                                        ->first();
    
        // Nếu chi tiết hóa đơn đã tồn tại, cập nhật số lượng và tính lại thành tiền
        if ($chiTietHoaDon) {
            // Cập nhật số lượng và tính lại tổng thành tiền
            $chiTietHoaDon->nvkSoLuongMua += $request->nvkSoLuong;  // Tăng số lượng
            $chiTietHoaDon->nvkThanhTien = $chiTietHoaDon->nvkSoLuongMua * $sanPham->nvkDonGia; // Tính lại thành tiền
            $chiTietHoaDon->save(); // Lưu cập nhật
        } else {
            // Nếu không tồn tại chi tiết hóa đơn, tạo mới chi tiết hóa đơn
            $nvkThanhTien = $request->nvkSoLuong * $sanPham->nvkDonGia;
    
            nvk_CT_HOA_DON::create([
                'nvkHoaDonID' => $hoaDon->id, // ID hóa đơn
                'nvkSanPhamID' => $sanPham->id, // ID sản phẩm
                'nvkSoLuongMua' => $request->nvkSoLuong, // Số lượng mua
                'nvkDonGiaMua' => $sanPham->nvkDonGia, // Đơn giá của sản phẩm
                'nvkThanhTien' => $nvkThanhTien, // Tổng thành tiền
                'nvkTrangThai' => 1,  // Trạng thái đơn hàng đã xác nhận
            ]);
        }
    
        // Quay lại trang chi tiết hóa đơn vừa tạo
        return redirect()->route('cthoadon.cthoadonshow', ['hoaDonId' => $hoaDon->id, 'sanPhamId' => $sanPham->id]);
    }
    


    
    
    

    
  // thanh toán
 // Hiển thị sản phẩm khi nhấn vào "Mua"
 public function nvkthanhtoan($product_id)
 {
     // Lấy sản phẩm theo ID sử dụng model
     $sanPham = nvk_SAN_PHAM::find($product_id);

     // Kiểm tra nếu không có sản phẩm
     if (!$sanPham) {
         abort(404, 'Sản phẩm không tồn tại');
     }

     // Trả về view với thông tin sản phẩm
     return view('nvkuser.thanhtoan', compact('sanPham'));
 }

 // Lưu thông tin thanh toán (chỉ cần lưu vào bảng thanh toán nếu cần, ở đây ta không tạo bảng ThanhToan)
 public function storeThanhtoan(Request $request)
 {
     // Lấy thông tin sản phẩm từ model SanPham
     $sanPham = nvk_SAN_PHAM::find($request->product_id);

     // Kiểm tra nếu không có sản phẩm
     if (!$sanPham) {
         return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại');
     }

     // Tính tổng tiền thanh toán
     $tongTien = $request->nvkSoLuong * $sanPham->nvkDonGia;

     // Nếu muốn lưu vào bảng thanh toán, bạn có thể thêm logic ở đây.
     // Nhưng ở đây chỉ cần hiển thị thông tin và tính tổng tiền.

     return view('nhtuser.thanhtoan', [
         'sanPham' => $sanPham,
         'nhtSoLuong' => $request->nvkSoLuong,
         'tongTien' => $tongTien
     ]);
 }

      //admin CRUD
    // list -----------------------------------------------------------------------------------------------------------------------------------------
    public function nvkList()
    {
        $nvkcthoadons = NVK_CT_HOA_DON::all();
        return view('nvkAdmins.nvkcthoadon.nvk-list',['nvkcthoadons'=>$nvkcthoadons]);
    }
    // detail -----------------------------------------------------------------------------------------------------------------------------------------
    public function nvkDetail($id)
    {
        // Tìm sản phẩm theo ID
        $nvkcthoadon = NVK_CT_HOA_DON::where('id', $id)->first();

        // Trả về view và truyền thông tin sản phẩm
        return view('nvkAdmins.nvkcthoadon.nvk-detail', ['nvkcthoadon' => $nvkcthoadon]);
    }

     // create-----------------------------------------------------------------------------------------------------------------------------------------
     public function nvkCreate()
     {
         $nvkhoadon = NVK_HOA_DON::all();
         $nvksanpham = NVK_SAN_PHAM::all();
         return view('nvkAdmins.nvkcthoadon.nvk-create',['nvkhoadon'=>$nvkhoadon,'nvksanpham'=>$nvksanpham]);
     }
     //post-----------------------------------------------------------------------------------------------------------------------------------------
     public function nvkCreateSubmit(Request $request)
     {
         // Xác thực dữ liệu yêu cầu dựa trên các quy tắc xác thực
         $validate = $request->validate([
             'nvkHoaDonID' => 'required|exists:nvk_hoa_don,id',
             'nvkSanPhamID' => 'required|exists:nvk_san_pham,id',
             'nvkSoLuongMua' => 'required|numeric',  
             'nvkDonGiaMua' => 'required|numeric',
             'nvkThanhTien' => 'required|numeric',  
             'nvkTrangThai' => 'required|in:0,1,2',
         ]);
     
         // Tạo một bản ghi hóa đơn mới
         $nvkcthoadon = new NVK_CT_HOA_DON;
     
         // Gán dữ liệu xác thực vào các thuộc tính của mô hình
         $nvkcthoadon->nvkHoaDonID = $request->nvkHoaDonID;
         $nvkcthoadon->nvkSanPhamID = $request->nvkSanPhamID;  
         $nvkcthoadon->nvkSoLuongMua = $request->nvkSoLuongMua;
         $nvkcthoadon->nvkDonGiaMua = $request->nvkDonGiaMua;
         $nvkcthoadon->nvkThanhTien = $request->nvkThanhTien;
         $nvkcthoadon->nvkTrangThai = $request->nvkTrangThai;
     
        
     
         // Lưu bản ghi mới vào cơ sở dữ liệu
         $nvkcthoadon->save();
     
         // Chuyển hướng đến danh sách hóa đơn
         return redirect()->route('nvkadmins.nvkcthoadon');
     }

      // edit-----------------------------------------------------------------------------------------------------------------------------------------
      public function nvkEdit($id)
{
    $nvkhoadon = NVK_HOA_DON::all(); // Lấy tất cả các hóa đơn
    $nvksanpham = NVK_SAN_PHAM::all(); // Lấy tất cả các sản phẩm

    // Lấy chi tiết hóa đơn cần chỉnh sửa
    $nvkcthoadon = NVK_CT_HOA_DON::where('id', $id)->first();

    if (!$nvkcthoadon) {
        // Nếu không tìm thấy chi tiết hóa đơn, chuyển hướng với thông báo lỗi
        return redirect()->route('nvkadmins.nvkcthoadon')->with('error', 'Không tìm thấy chi tiết hóa đơn!');
    }

    // Trả về view với dữ liệu
    return view('nvkAdmins.nvkcthoadon.nvk-edit', [
        'nvkhoadon' => $nvkhoadon,
        'nvksanpham' => $nvksanpham,
        'nvkcthoadon' => $nvkcthoadon
    ]);
}

      //post-----------------------------------------------------------------------------------------------------------------------------------------
      public function nvkEditSubmit(Request $request,$id)
      {
          // Xác thực dữ liệu yêu cầu dựa trên các quy tắc xác thực
          $validate = $request->validate([
              'nvkHoaDonID' => 'required|exists:nvk_hoa_don,id',
              'nvkSanPhamID' => 'required|exists:nvk_san_pham,id',
              'nvkSoLuongMua' => 'required|numeric',  
              'nvDonGiaMua' => 'required|numeric',
              'nvkThanhTien' => 'required|numeric',  
              'nvkTrangThai' => 'required|in:0,1,2',
          ]);
         
      
          // Tạo một bản ghi hóa đơn mới
          $nvkcthoadon = NVK_CT_HOA_DON::where('id', $id)->first();
      
          // Gán dữ liệu xác thực vào các thuộc tính của mô hình
          $nvkcthoadon->nvkHoaDonID = $request->nvkHoaDonID;
          $nvkcthoadon->nvkSanPhamID = $request->nvkSanPhamID;  
          $nvkcthoadon->nvkSoLuongMua = $request->nvkSoLuongMua;
          $nvkcthoadon->nvkDonGiaMua = $request->nvkDonGiaMua;
          $nvkcthoadon->nvkThanhTien = $request->nvkThanhTien;
          $nvkcthoadon->nvkTrangThai = $request->nvkTrangThai;
      
         
      
          // Lưu bản ghi mới vào cơ sở dữ liệu
          $nvkcthoadon->save();
      
          // Chuyển hướng đến danh sách hóa đơn
          return redirect()->route('nvkadmins.nvkcthoadon');
      }

        //delete
        public function nvkDelete($id)
        {
            NVK_CT_HOA_DON::where('id',$id)->delete();
            return back()->with('cthoadon_deleted','Đã xóa Khách hàng thành công!');
        }
     
}
