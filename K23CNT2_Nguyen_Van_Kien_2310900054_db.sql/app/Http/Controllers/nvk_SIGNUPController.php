<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class nvk_SIGNUPController extends Controller
{
    // Show the form to create a new customer
    public function nvksignup()
    {
        return view('nvkuser.signup');
    }

    // Handle the form submission and store customer data
    public function nvksignupSubmit(Request $request)
    {
        // Validate the input data
        $request->validate([
            'nvkHoTenKhachHang' => 'required|string|max:255',
            'nvkEmail' => 'required|email|unique:nvk_khach_hang,nvkEmail',
            'nvkMatKhau' => 'required|min:6',
            'nvkDienThoai' => 'required|numeric|unique:nvk_khach_hang,nvkDienThoai',
            'nvkDiaChi' => 'required|string|max:255',
        ]);

        // Generate a new customer ID (nvkMaKhachHang)
        $lastCustomer = NVK_KHACH_HANG::latest('nvkMaKhachHang')->first(); // Get the latest customer to determine the next ID
    
        // If no customers exist, start with KH001
        if ($lastCustomer) {
            $newCustomerID = 'KH' . str_pad((substr($lastCustomer->nvkMaKhachHang, 2) + 1), 3, '0', STR_PAD_LEFT);  // e.g., KH001, KH002, etc.
        } else {
            $newCustomerID = 'KH001'; // First customer will be KH001
        }
    
        // Create a new customer record
        $nvkkhachhang = new NVK_KHACH_HANG;
        $nvkkhachhang->nvkMaKhachHang = $newCustomerID; // Automatically generated ID
        $nvkkhachhang->nvkHoTenKhachHang = $request->nvkHoTenKhachHang;
        $nvkkhachhang->nvkEmail = $request->nvkEmail;
        $nvkkhachhang->nvkMatKhau = $request->nvkMatKhau; // Encrypt the password
        $nvkkhachhang->nvkDienThoai = $request->nvkDienThoai;
        $nvkkhachhang->nvkDiaChi = $request->nvkDiaChi;
        $nvkkhachhang->nvkNgayDangKy = now(); // Set the current timestamp for registration date
        $nvkkhachhang->nvkTrangThai = 0; // Set the default value for nvkTrangThai to 0 (inactive or unverified)
    
        // Save the new customer data
        try {
            $nvkkhachhang->save();
            // Redirect to login page on success with a success message
            return redirect()->route('nvkuser.login')->with('success', 'Đăng ký thành công, vui lòng đăng nhập!');
        } catch (\Exception $e) {
            // In case of error, return to the previous page with an error message
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }
}
