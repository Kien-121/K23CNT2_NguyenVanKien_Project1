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
        $userId = Session::get('nhtMaKhachHang'); // Lấy ID khách hàng từ session
    
        // Kiểm tra nếu không có khách hàng trong session
        if (!$userId) {
            return redirect()->route('nhtuser.login')->with('error', 'Vui lòng đăng nhập để tiếp tục!');
        }
    
        // Kiểm tra khách hàng tồn tại trong bảng nht_KHACH_HANG
        $khachhang = nht_KHACH_HANG::find($userId);
        if (!$khachhang) {
            return redirect()->route('nhtuser.login')->with('error', 'Khách hàng không tồn tại.');
        }
    
        // Lấy thông tin sản phẩm từ bảng nht_SAN_PHAM
        $sanPham = nht_SAN_PHAM::find($request->nhtSanPhamId);
        if (!$sanPham) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }
    
        // Tạo mã hóa đơn tự động (nhtMaHoaDon)
        $nhtMaHoaDon = 'HD' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT); // Tạo mã hóa đơn ngẫu nhiên
    
        // Tạo hóa đơn mới với thông tin lấy từ khách hàng
        $hoaDon = nht_HOA_DON::create([
            'nhtMaHoaDon' => $nhtMaHoaDon,
            'nhtMaKhachHang' => $khachhang->id,  // Sử dụng ID của khách hàng từ bảng nht_KHACH_HANG
            'nhtNgayHoaDon' => Carbon::now()->toDateString(),
            'nhtNgayNhan' => Carbon::now()->addDays(3)->toDateString(),
            'nhtHoTenKhachHang' => $request->nhtHoTenKhachHang,
            'nhtEmail' => $request->nhtEmail,
            'nhtDienThoai' => $request->nhtDienThoai,
            'nhtDiaChi' => $request->nhtDiaChi,
            'nhtTongGiaTri' => $sanPham->nhtDonGia * $request->nhtSoLuong, // Tính tổng giá trị
            'nhtTrangThai' => 0, // 0 nghĩa là chưa thanh toán
        ]);
     
        // Quay lại trang chi tiết hóa đơn vừa tạo
        return redirect()->route('hoadon.show', ['hoaDonId' => $hoaDon->id, 'sanPhamId' => $sanPham->id]);
    }
    
    
    

// xem cthoadon
public function create($hoaDonId, $sanPhamId)
{
    // Lấy thông tin hóa đơn và sản phẩm
    $hoaDon = nht_HOA_DON::find($hoaDonId);
    $sanPham = nht_SAN_PHAM::find($sanPhamId);

    // Kiểm tra nếu hóa đơn hoặc sản phẩm không tồn tại
    if (!$hoaDon || !$sanPham) {
        return redirect()->route('hoadon.index')->with('error', 'Hóa đơn hoặc sản phẩm không tồn tại.');
    }
 // Lấy số lượng từ request
 $soLuong = request('nhtSoLuong', 1); // Số lượng mặc định là 1 nếu không có giá trị
    // Truyền dữ liệu vào view
    return view('nhtuser.cthoadon', [
        'hoaDon' => $hoaDon,
        'sanPham' => $sanPham,
        'soLuong' => $soLuong // Truyền số lượng vào view
    ]);
}


public function cthoadonshow($hoaDonId, $sanPhamId)
{
    // Lấy hóa đơn từ ID
    $hoaDon = nht_HOA_DON::findOrFail($hoaDonId);

    // Lấy chi tiết hóa đơn từ ID
    $chiTietHoaDon = nht_CT_HOA_DON::where('nhtHoaDonID', $hoaDonId)
                                    ->where('nhtSanPhamID', $sanPhamId)
                                    ->firstOrFail();

    // Trả về view và truyền dữ liệu
    return view('nhtuser.cthoadonshow', compact('hoaDon', 'chiTietHoaDon'));
}





    public function storecthoadon(Request $request)
    {
        // Validate các dữ liệu yêu cầu
        $validated = $request->validate([
            'nhtSanPhamID' => 'required|exists:nht_SAN_PHAM,id',
            'nhtHoaDonID' => 'required|exists:nht_HOA_DON,id',
            'nhtSoLuong' => 'required|integer|min:1',
        ]);
    
        // Lấy thông tin sản phẩm và hóa đơn
        $sanPham = nht_SAN_PHAM::find($request->nhtSanPhamID);
        $hoaDon = nht_HOA_DON::find($request->nhtHoaDonID);
    
        // Kiểm tra xem sản phẩm và hóa đơn có tồn tại không
        if (!$sanPham || !$hoaDon) {
            return redirect()->back()->with('error', 'Sản phẩm hoặc hóa đơn không tồn tại.');
        }
    
        // Kiểm tra xem chi tiết hóa đơn đã tồn tại chưa
        $chiTietHoaDon = nht_CT_HOA_DON::where('nhtHoaDonID', $hoaDon->id)
                                        ->where('nhtSanPhamID', $sanPham->id)
                                        ->first();
    
        // Nếu chi tiết hóa đơn đã tồn tại, cập nhật số lượng và tính lại thành tiền
        if ($chiTietHoaDon) {
            // Cập nhật số lượng và tính lại tổng thành tiền
            $chiTietHoaDon->nhtSoLuongMua += $request->nhtSoLuong;  // Tăng số lượng
            $chiTietHoaDon->nhtThanhTien = $chiTietHoaDon->nhtSoLuongMua * $sanPham->nhtDonGia; // Tính lại thành tiền
            $chiTietHoaDon->save(); // Lưu cập nhật
        } else {
            // Nếu không tồn tại chi tiết hóa đơn, tạo mới chi tiết hóa đơn
            $nhtThanhTien = $request->nhtSoLuong * $sanPham->nhtDonGia;
    
            nht_CT_HOA_DON::create([
                'nhtHoaDonID' => $hoaDon->id, // ID hóa đơn
                'nhtSanPhamID' => $sanPham->id, // ID sản phẩm
                'nhtSoLuongMua' => $request->nhtSoLuong, // Số lượng mua
                'nhtDonGiaMua' => $sanPham->nhtDonGia, // Đơn giá của sản phẩm
                'nhtThanhTien' => $nhtThanhTien, // Tổng thành tiền
                'nhtTrangThai' => 1,  // Trạng thái đơn hàng đã xác nhận
            ]);
        }
    
        // Quay lại trang chi tiết hóa đơn vừa tạo
        return redirect()->route('cthoadon.cthoadonshow', ['hoaDonId' => $hoaDon->id, 'sanPhamId' => $sanPham->id]);
    }
    


    
    
    

    
  // thanh toán
 // Hiển thị sản phẩm khi nhấn vào "Mua"
 public function nhtthanhtoan($product_id)
 {
     // Lấy sản phẩm theo ID sử dụng model
     $sanPham = nht_SAN_PHAM::find($product_id);

     // Kiểm tra nếu không có sản phẩm
     if (!$sanPham) {
         abort(404, 'Sản phẩm không tồn tại');
     }

     // Trả về view với thông tin sản phẩm
     return view('nhtuser.thanhtoan', compact('sanPham'));
 }

 // Lưu thông tin thanh toán (chỉ cần lưu vào bảng thanh toán nếu cần, ở đây ta không tạo bảng ThanhToan)
 public function storeThanhtoan(Request $request)
 {
     // Lấy thông tin sản phẩm từ model SanPham
     $sanPham = nht_SAN_PHAM::find($request->product_id);

     // Kiểm tra nếu không có sản phẩm
     if (!$sanPham) {
         return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại');
     }

     // Tính tổng tiền thanh toán
     $tongTien = $request->nhtSoLuong * $sanPham->nhtDonGia;

     // Nếu muốn lưu vào bảng thanh toán, bạn có thể thêm logic ở đây.
     // Nhưng ở đây chỉ cần hiển thị thông tin và tính tổng tiền.

     return view('nhtuser.thanhtoan', [
         'sanPham' => $sanPham,
         'nhtSoLuong' => $request->nhtSoLuong,
         'tongTien' => $tongTien
     ]);
 }

      //admin CRUD
    // list -----------------------------------------------------------------------------------------------------------------------------------------
    public function nhtList()
    {
        $nhtcthoadons = NHT_CT_HOA_DON::all();
        return view('nhtAdmins.nhtcthoadon.nht-list',['nhtcthoadons'=>$nhtcthoadons]);
    }
    // detail -----------------------------------------------------------------------------------------------------------------------------------------
    public function nhtDetail($id)
    {
        // Tìm sản phẩm theo ID
        $nhtcthoadon = NHT_CT_HOA_DON::where('id', $id)->first();

        // Trả về view và truyền thông tin sản phẩm
        return view('nhtAdmins.nhtcthoadon.nht-detail', ['nhtcthoadon' => $nhtcthoadon]);
    }

     // create-----------------------------------------------------------------------------------------------------------------------------------------
     public function nhtCreate()
     {
         $nhthoadon = NHT_HOA_DON::all();
         $nhtsanpham = NHT_SAN_PHAM::all();
         return view('nhtAdmins.nhtcthoadon.nht-create',['nhthoadon'=>$nhthoadon,'nhtsanpham'=>$nhtsanpham]);
     }
     //post-----------------------------------------------------------------------------------------------------------------------------------------
     public function nhtCreateSubmit(Request $request)
     {
         // Xác thực dữ liệu yêu cầu dựa trên các quy tắc xác thực
         $validate = $request->validate([
             'nhtHoaDonID' => 'required|exists:nht_hoa_don,id',
             'nhtSanPhamID' => 'required|exists:nht_san_pham,id',
             'nhtSoLuongMua' => 'required|numeric',  
             'nhtDonGiaMua' => 'required|numeric',
             'nhtThanhTien' => 'required|numeric',  
             'nhtTrangThai' => 'required|in:0,1,2',
         ]);
     
         // Tạo một bản ghi hóa đơn mới
         $nhtcthoadon = new NHT_CT_HOA_DON;
     
         // Gán dữ liệu xác thực vào các thuộc tính của mô hình
         $nhtcthoadon->nhtHoaDonID = $request->nhtHoaDonID;
         $nhtcthoadon->nhtSanPhamID = $request->nhtSanPhamID;  
         $nhtcthoadon->nhtSoLuongMua = $request->nhtSoLuongMua;
         $nhtcthoadon->nhtDonGiaMua = $request->nhtDonGiaMua;
         $nhtcthoadon->nhtThanhTien = $request->nhtThanhTien;
         $nhtcthoadon->nhtTrangThai = $request->nhtTrangThai;
     
        
     
         // Lưu bản ghi mới vào cơ sở dữ liệu
         $nhtcthoadon->save();
     
         // Chuyển hướng đến danh sách hóa đơn
         return redirect()->route('nhtadmins.nhtcthoadon');
     }

      // edit-----------------------------------------------------------------------------------------------------------------------------------------
      public function nhtEdit($id)
{
    $nhthoadon = NHT_HOA_DON::all(); // Lấy tất cả các hóa đơn
    $nhtsanpham = NHT_SAN_PHAM::all(); // Lấy tất cả các sản phẩm

    // Lấy chi tiết hóa đơn cần chỉnh sửa
    $nhtcthoadon = NHT_CT_HOA_DON::where('id', $id)->first();

    if (!$nhtcthoadon) {
        // Nếu không tìm thấy chi tiết hóa đơn, chuyển hướng với thông báo lỗi
        return redirect()->route('nhtadmins.nhtcthoadon')->with('error', 'Không tìm thấy chi tiết hóa đơn!');
    }

    // Trả về view với dữ liệu
    return view('nhtAdmins.nhtcthoadon.nht-edit', [
        'nhthoadon' => $nhthoadon,
        'nhtsanpham' => $nhtsanpham,
        'nhtcthoadon' => $nhtcthoadon
    ]);
}

      //post-----------------------------------------------------------------------------------------------------------------------------------------
      public function nhtEditSubmit(Request $request,$id)
      {
          // Xác thực dữ liệu yêu cầu dựa trên các quy tắc xác thực
          $validate = $request->validate([
              'nhtHoaDonID' => 'required|exists:nht_hoa_don,id',
              'nhtSanPhamID' => 'required|exists:nht_san_pham,id',
              'nhtSoLuongMua' => 'required|numeric',  
              'nhtDonGiaMua' => 'required|numeric',
              'nhtThanhTien' => 'required|numeric',  
              'nhtTrangThai' => 'required|in:0,1,2',
          ]);
         
      
          // Tạo một bản ghi hóa đơn mới
          $nhtcthoadon = NHT_CT_HOA_DON::where('id', $id)->first();
      
          // Gán dữ liệu xác thực vào các thuộc tính của mô hình
          $nhtcthoadon->nhtHoaDonID = $request->nhtHoaDonID;
          $nhtcthoadon->nhtSanPhamID = $request->nhtSanPhamID;  
          $nhtcthoadon->nhtSoLuongMua = $request->nhtSoLuongMua;
          $nhtcthoadon->nhtDonGiaMua = $request->nhtDonGiaMua;
          $nhtcthoadon->nhtThanhTien = $request->nhtThanhTien;
          $nhtcthoadon->nhtTrangThai = $request->nhtTrangThai;
      
         
      
          // Lưu bản ghi mới vào cơ sở dữ liệu
          $nhtcthoadon->save();
      
          // Chuyển hướng đến danh sách hóa đơn
          return redirect()->route('nhtadmins.nhtcthoadon');
      }

        //delete
        public function nhtDelete($id)
        {
            NHT_CT_HOA_DON::where('id',$id)->delete();
            return back()->with('cthoadon_deleted','Đã xóa Khách hàng thành công!');
        }
     
}
