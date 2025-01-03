<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class nvk_LOGIN_USERController extends Controller
{
    /// Show login form
    public function nhtLogin()
    {
        return view('nvkuser.login');
    }

    // Handle login form submission
    public function nvkLoginSubmit(Request $request)
{
    // Validate the input data
    $request->validate([
        'nvkEmail' => 'required|email',
        'nvkMatKhau' => 'required|string',
    ]);

    // Tìm người dùng theo email
    $user = NVK_KHACH_HANG::where('nvkEmail', $request->nvkEmail)->first();

    // Kiểm tra nếu người dùng tồn tại và mật khẩu đúng
    if ($user && Hash::check($request->nvkMatKhau, $user->nvkMatKhau)) {
        // Đăng nhập người dùng
        Auth::login($user);

        // Lưu thông tin người dùng vào session
        Session::put('username1', $user->nvkHoTenKhachHang);  // Lưu tên người dùng
        Session::put('nvkEmail', $user->nvkEmail);  // Lưu email
        Session::put('nvkDienThoai', $user->nvkDienThoai);  // Lưu số điện thoại
        Session::put('nvkDiaChi', $user->nvkDiaChi);  // Lưu địa chỉ
        Session::put('nvkMaKhachHang', $user->nvkMaKhachHang);  // Lưu mã khách hàng

        // Lưu trữ các thông tin cần thiết vào session

        // Chuyển hướng người dùng tới trang chủ sau khi đăng nhập thành công
        return redirect()->route('nvkuser.home1')->with('message', 'Đăng Nhập Thành Công');
    } else {
        // Nếu thông tin không chính xác, trả về lỗi
        return redirect()->back()->withErrors(['nvkEmail' => 'Email hoặc Mật khẩu không đúng']);
    }
}

}
