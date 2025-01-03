<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NVK_SAN_PHAM; 
use App\Models\NVK_LOAI_SAN_PHAM; // Sử dụng Model User để thao tác với cơ sở dữ liệu
use Illuminate\Support\Facades\Storage;  // Use this for file handling
class NVK_SAN_PHAMController extends Controller
{
     // In your controller
     public function search(Request $request)
     {
         // Lấy từ khóa tìm kiếm từ input của người dùng
         $search = $request->input('search');
     
         // Nếu có từ khóa tìm kiếm, lọc sản phẩm theo tên
         if ($search) {
             // Sử dụng where để lọc các sản phẩm có tên giống hoặc chứa từ khóa tìm kiếm
             $products = NVK_SAN_PHAM::where('nvkTenSanPham', 'like', '%' . $search . '%')->paginate(10);
         } else {
             // Nếu không có từ khóa tìm kiếm, hiển thị tất cả sản phẩm
             $products = NVK_SAN_PHAM::paginate(10);
         }
     
         // Trả về view với danh sách sản phẩm và từ khóa tìm kiếm   
         return view('nvkuser.search', compact('products', 'search'));
     }
 
     public function search1(Request $request)
     {
         // Lấy từ khóa tìm kiếm từ input của người dùng
         $search = $request->input('search');
     
         // Nếu có từ khóa tìm kiếm, lọc sản phẩm theo tên
         if ($search) {
             // Sử dụng where để lọc các sản phẩm có tên giống hoặc chứa từ khóa tìm kiếm
             $products = NVK_SAN_PHAM::where('nvkTenSanPham', 'like', '%' . $search . '%')->paginate(10);
         } else {
             // Nếu không có từ khóa tìm kiếm, hiển thị tất cả sản phẩm
             $products = NVK_SAN_PHAM::paginate(10);
         }
     
         // Trả về view với danh sách sản phẩm và từ khóa tìm kiếm   
         return view('nvkuser.search1', compact('products', 'search'));
     }
 
 
     // search sap pham admin
     public function searchAdmins(Request $request)
     {
         // Lấy từ khóa tìm kiếm từ input của người dùng
         $search = $request->input('search');
     
         // Nếu có từ khóa tìm kiếm, lọc sản phẩm theo tên
         if ($search) {
             // Sử dụng where để lọc các sản phẩm có tên giống hoặc chứa từ khóa tìm kiếm
             $products = NVK_SAN_PHAM::where('nvkTenSanPham', 'like', '%' . $search . '%')->paginate(10);
         } else {
             // Nếu không có từ khóa tìm kiếm, hiển thị tất cả sản phẩm
             $products = NVK_SAN_PHAM::paginate(10);
         }
     
         // Trả về view với danh sách sản phẩm và từ khóa tìm kiếm   
         return view('nvkAdmins.nvksanpham.nvk-search', compact('products', 'search'));
     }
 


     //admin CRUD
    // list -----------------------------------------------------------------------------------------------------------------------------------------
    public function nvkList()
    {
        $nvksanphams = NVK_SAN_PHAM::where('nvkTrangThai',0)->get();
        return view('nvkAdmins.nvksanpham.nvk-list',['nvksanphams'=>$nvksanphams]);
    } 
    // detail -----------------------------------------------------------------------------------------------------------------------------------------
    public function nvkDetail($id)
    {
        // Tìm sản phẩm theo ID
        $nvksanpham = NVK_SAN_PHAM::where('id', $id)->first();

        // Trả về view và truyền thông tin sản phẩm
        return view('nvkAdmins.nvksanpham.nvk-detail', ['nvksanpham' => $nvksanpham]);
    }

      //create  -----------------------------------------------------------------------------------------------------------------------------------------
      public function nvkCreate()
      {
            // đọc dữ liệu từ nvk_LOAI_SAN_PHAM
            $nvkloaisanpham = NVK_LOAI_SAN_PHAM::all();
          return view('nvkAdmins.nvksanpham.nvk-create',['nvkloaisanpham'=>$nvkloaisanpham]);
      }
     

     // Controller
public function nvkCreateSubmit(Request $request)
{

    // Validate input
    $validatedData = $request->validate([
        'nvkMaSanPham' => 'required|unique:nvk_SAN_PHAM,nvkMaSanPham',
        'nvkTenSanPham' => 'required|string|max:255',
        'nvkHinhAnh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // Kiểm tra hình ảnh và loại định dạng
        'nvkSoLuong' => 'required|numeric|min:1',
        'nvkDonGia' => 'required|numeric',
        'nvkMaLoai' => 'required|exists:nvk_LOAI_SAN_PHAM,id',
        'nvkTrangThai' => 'required|in:0,1',
    ]);

    // Khởi tạo đối tượng nht_SAN_PHAM và lưu thông tin vào cơ sở dữ liệu
    $nvksanpham = new NVK_SAN_PHAM;
    $nvksanpham->nvkMaSanPham = $request->nvkMaSanPham;
    $nvksanpham->nvkTenSanPham = $request->nvkTenSanPham;

    // Kiểm tra nếu có tệp hình ảnh
    if ($request->hasFile('nvkHinhAnh')) {
        // Lấy tệp hình ảnh
        $file = $request->file('nvkHinhAnh');

        // Kiểm tra nếu tệp hợp lệ
        if ($file->isValid()) {
            // Tạo tên tệp dựa trên mã sản phẩm
            $fileName = $request->nvkMaSanPham . '.' . $file->extension();

            // Lưu tệp vào thư mục public/img/san_pham
            $file->storeAs('public/img/san_pham', $fileName); // Lưu tệp vào thư mục storage/app/public/img/san_pham

            // Lưu đường dẫn vào cơ sở dữ liệu
            $nvksanpham->nvkHinhAnh = 'img/san_pham/' . $fileName; // Lưu đường dẫn tương đối trong CSDL
        }
    }

    // Lưu các thông tin còn lại vào cơ sở dữ liệu
    $nvksanpham->nvkSoLuong = $request->nvkSoLuong;
    $nvksanpham->nvkDonGia = $request->nvkDonGia;
    $nvksanpham->nvkMaLoai = $request->nvkMaLoai;
    $nvksanpham->nvkTrangThai = $request->nvkTrangThai;

    // Lưu dữ liệu vào cơ sở dữ liệu
    $nvksanpham->save();

    // Chuyển hướng người dùng về trang danh sách sản phẩm
    return redirect()->route('nvkadims.nvksanpham');
}

//delete    -----------------------------------------------------------------------------------------------------------------------------------------

public function nvkdelete($id)
{
    NVK_SAN_PHAM::where('id',$id)->delete();
return back()->with('sanpham_deleted','Đã xóa Sản Phẩm thành công!');
}

// edit -----------------------------------------------------------------------------------------------------------------------------------------
public function nvkEdit($id)
    {
       // Tìm sản phẩm theo ID
    $nvksanpham = NVK_SAN_PHAM::findOrFail($id);

    // Lấy tất cả các loại sản phẩm từ bảng nvk_LOAI_SAN_PHAM
    $nvkloaisanpham = NVK_LOAI_SAN_PHAM::all();

    // Trả về view với dữ liệu sản phẩm và loại sản phẩm
    return view('nvkAdmins.nvksanpham.nvk-edit', [
        'nvksanpham' => $nvksanpham,
        'nvkloaisanpham' => $nvkloaisanpham
    ]);
    }

    // Phương thức xử lý dữ liệu form chỉnh sửa sản phẩm


    public function nvkEditSubmit(Request $request, $id)
{
    // Validate dữ liệu
    $request->validate([
        'nvkMaSanPham' => 'required|max:20',
        'nvkTenSanPham' => 'required|max:255',
        'nvkHinhAnh' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'nvkSoLuong' => 'required|integer',
        'nvkDonGia' => 'required|numeric',
        'nvkMaLoai' => 'required|max:10',
        'nvkTrangThai' => 'required|in:0,1',
    ]);

    // Tìm sản phẩm cần chỉnh sửa
    $nvksanpham = NVK_SAN_PHAM::findOrFail($id);

    // Cập nhật thông tin sản phẩm
    $nvksanpham->nvkMaSanPham = $request->nvkMaSanPham;
    $nvksanpham->nvkTenSanPham = $request->nvkTenSanPham;
    $nvksanpham->nvkSoLuong = $request->nvkSoLuong;
    $nvksanpham->nvkDonGia = $request->nvkDonGia; 
    $nvksanpham->nvkMaLoai = $request->nvkMaLoai;
    $nvksanpham->nvkTrangThai = $request->nvkTrangThai;

    // Kiểm tra nếu có hình ảnh mới
    if ($request->hasFile('nvkHinhAnh')) {
        // Kiểm tra và xóa hình ảnh cũ nếu tồn tại
        if ($nvksanpham->nvkHinhAnh && Storage::disk('public')->exists('img/san_pham/' . $nvksanpham->nvkHinhAnh)) {
            // Xóa file cũ nếu tồn tại
            Storage::disk('public')->delete('img/san_pham/' . $nvksanpham->nvkHinhAnh);
        }
        // Lưu hình ảnh mới
        $imagePath = $request->file('nvkHinhAnh')->store('img/san_pham', 'public');
        $nvksanpham->nvkHinhAnh = $imagePath;
    }

    // Lưu thông tin sản phẩm đã chỉnh sửa
    $nvksanpham->save();

    // Redirect về trang danh sách sản phẩm
    return redirect()->route('nvkadims.nvksanpham')->with('success', 'Sản phẩm đã được cập nhật thành công.');
}

    

}