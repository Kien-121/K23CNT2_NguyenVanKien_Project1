<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\NVK_SAN_PHAM; 
use App\Models\NVK_KHACH_HANG; 
use App\Models\NVK_TIN_TUC; 

class NVK_DANH_SACH_QUAN_TRIController extends Controller
{
    // Danh mục
    public function danhmuc()
    {
        // Truy vấn số lượng sản phẩm
        $productCount = NVK_SAN_PHAM::count();
    
        // Truy vấn số lượng người dùng
        $userCount = NVK_KHACH_HANG::count();
        $ttCount = NVK_TIN_TUC::count();

    
        // Trả về view và truyền cả productCount và userCount
        return view('nvkAdmins.nvkdanhsachquantri.nvkdanhmuc', compact('productCount', 'userCount','ttCount'));
    }

    public function nguoidung()
    {
        $nvknguoidung = NVK_KHACH_HANG::all();
    
        // Chuyển đổi nvkNgayDangKy thành đối tượng Carbon thủ công
        foreach ($nvknguoidung as $user) {
            // Chuyển đổi ngày tháng thành đối tượng Carbon nếu chưa phải là Carbon
            $user->nvkNgayDangKy = Carbon::parse($user->nvkNgayDangKy);
        }
    
        return view('nvkAdmins.nvkdanhsachquantri.nvkdanhmuc.nvknguoidung', ['nvknguoidung' => $nvknguoidung]);
    } 
    

    public function tintuc()
    {
        // Retrieve all news articles from the database (assuming you have a model named nvk_TIN_TUC)
        $nvktintucs = nvk_TIN_TUC::all();  // Fetching all articles
    
        // Loop through articles and add the full URL to the image
        foreach ($nvktintucs as $article) {
            // Assuming nvkHinhAnh stores the image name, we'll prepend the 'public/storage' path
            $article->image_url = asset('storage/' . $article->nvkHinhAnh);
        }
    
        // Return the view and pass the articles to it
        return view('nvkAdmins.nvkdanhsachquantri.nvkdanhmuc.nvktintuc', [
            'nvktintucs' => $nvktintucs, // Passing the news articles to the view
        ]);
    }
    


// Hiển thị danh sách sản phẩm
public function sanpham()
{
    $nvksanphams = NVK_SAN_PHAM::all(); // Lấy tất cả sản phẩm
    return view('nvkAdmins.nvkdanhsachquantri.nvkdanhmuc.nvksanpham', ['nvksanphams' => $nvksanphams]);
}

// Hiển thị mô tả chi tiết sản phẩm
public function mota($id)
{
    // Lấy sản phẩm theo id
    $product = NVK_SAN_PHAM::find($id);
    
    // Kiểm tra nếu sản phẩm không tồn tại
    if (!$product) {
        return redirect()->route('nvkAdmins.nvkdanhsachquantri.nvkdanhmuc.nvksanpham')
                         ->with('error', 'Sản phẩm không tồn tại.');
    }

    // Trả về view với thông tin sản phẩm
    return view('nvkAdmins.nvkdanhsachquantri.nvkdanhmuc.nvkmota', ['product' => $product]);
}
}
