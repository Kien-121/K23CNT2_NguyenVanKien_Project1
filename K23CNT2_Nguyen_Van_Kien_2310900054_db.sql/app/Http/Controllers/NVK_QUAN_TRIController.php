<?php

namespace App\Http\Controllers;

use App\Models\NVK_QUAN_TRI; // Sử dụng Model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class NVK_QUAN_TRIController extends Controller
{
    // get login
    public function nvklogin()
    {
        return view('nvklogin.nvk-login');
    }

    // post login
    public function nvkloginSubmit(Request $request)
    {
        // Validate tài khoản và mật khẩu
        $request->validate([
            'nvkTaiKhoan' => 'required|string',
            'nvkMatKhau' => 'required|string',
        ]);

        // Tìm người dùng trong bảng nvk_QUAN_TRI
        $user = NVK_QUAN_TRI::where('nvkTaiKhoan', $request->nvkTaiKhoan)->first(); // Sửa lại ở đây

        // Kiểm tra nếu người dùng tồn tại và mật khẩu đúng
        if ($user && Hash::check($request->nvkMatKhau, $user->nvkMatKhau)) {
            // Đăng nhập thành công
            Auth::loginUsingId($user->id);

            // Lưu tên tài khoản vào session
            Session::put('username', $user->nvkTaiKhoan);

            // Chuyển hướng về trang admin với thông báo thành công
            return redirect('/nvk-admins')->with('message', 'Đăng Nhập Thành Công');
        } else {
            // Thông báo lỗi nếu tài khoản hoặc mật khẩu sai
            return redirect()->back()->withErrors(['nvkMatKhau' => 'Tài khoản hoặc mật khẩu không đúng']);
        }
    }

    // Lấy tất cả quản trị viên
    public function nvklist()
    {
        $nvkquantri = NVK_QUAN_TRI::all(); // Sử dụng Model NVK_QUAN_TRI
        return view('nvkAdmins.nvkquantri.nvk-list', ['nvkquantris' => $nvkquantri]);
    }

    // Lấy chi tiết quản trị viên
    public function nvkDetail($id)
    {
        $nvkquantri = NVK_QUAN_TRI::where('id', $id)->first(); // Sử dụng Model NVK_QUAN_TRI
        return view('nvkAdmins.nvkquantri.nvk-detail', ['nvkquantri' => $nvkquantri]);
    }

    // Hiển thị form thêm mới quản trị viên
    public function nvkCreate()
    {
        return view('nvkAdmins.nvkquantri.nvk-create');
    }

    // Xử lý form thêm mới quản trị viên
    public function nvkCreateSubmit(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'nvkTaiKhoan' => 'required|string|unique:nvk_quan_tri,nvkTaiKhoan',
            'nvkMatKhau' => 'required|string|min:6',
            'nvkTrangThai' => 'required|in:0,1',
        ]);

        // Tạo bản ghi mới trong cơ sở dữ liệu
        $nvkquantri = new NVK_QUAN_TRI(); // Sử dụng Model NVK_QUAN_TRI
        $nvkquantri->nvkTaiKhoan = $request->nvkTaiKhoan;
        $nvkquantri->nvkMatKhau = Hash::make($request->nvkMatKhau); // Mã hóa mật khẩu
        $nvkquantri->nvkTrangThai = $request->nvkTrangThai;
        $nvkquantri->save(); // Lưu bản ghi vào cơ sở dữ liệu

        // Chuyển hướng về trang danh sách với thông báo thành công
        return redirect()->route('nvkadmins.nvkquantri')->with('success', 'Thêm quản trị viên thành công');
    }

    // Hiển thị form chỉnh sửa quản trị viên
    public function nvkEdit($id)
    {
        $nvkquantri = NVK_QUAN_TRI::find($id); // Sử dụng phương thức find của Model
        if (!$nvkquantri) {
            return redirect()->route('nvkadmins.nvkquantri')->with('error', 'Không tìm thấy quản trị viên!');
        }
        return view('nvkAdmins.nvkquantri.nvk-edit', ['nvkquantri' => $nvkquantri]);
    }

    // Xử lý form chỉnh sửa quản trị viên
    public function nvkEditSubmit(Request $request, $id)
    {
        // Xác thực dữ liệu
        $request->validate([
            'nvkTaiKhoan' => 'required|string|unique:nvk_quan_tri,nvkTaiKhoan,' . $id,
            'nvkMatKhau' => 'nullable|string|min:6', // Cho phép mật khẩu trống
            'nvkTrangThai' => 'required|in:0,1',
        ]);

        // Lấy quản trị viên cần sửa
        $nvkquantri = NVK_QUAN_TRI::find($id); // Sử dụng phương thức find của Model
        if (!$nvkquantri) {
            return redirect()->route('nvkadmins.nvkquantri')->with('error', 'Không tìm thấy quản trị viên!');
        }

        // Cập nhật thông tin
        $nvkquantri->nvkTaiKhoan = $request->nvkTaiKhoan;
        if ($request->nvkMatKhau) {
            $nvkquantri->nvkMatKhau = Hash::make($request->nvkMatKhau); // Cập nhật mật khẩu nếu có
        }
        $nvkquantri->nvkTrangThai = $request->nvkTrangThai;
        $nvkquantri->save(); // Lưu lại thay đổi

        return redirect()->route('nvkadmins.nvkquantri')->with('success', 'Cập nhật quản trị viên thành công');
    }

    // Xóa quản trị viên
    public function nvkDelete($id)
    {
        $nvkquantri = NVK_QUAN_TRI::find($id); // Sử dụng phương thức find của Model
        if (!$nvkquantri) {
            return redirect()->route('nvkadmins.nvkquantri')->with('error', 'Không tìm thấy quản trị viên!');
        }
        $nvkquantri->delete(); // Xóa bản ghi

        return redirect()->route('nvkadmins.nvkquantri')->with('success', 'Xóa quản trị viên thành công');
    }
}
