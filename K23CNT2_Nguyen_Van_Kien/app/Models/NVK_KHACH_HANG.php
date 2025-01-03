<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Thêm dòng này
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NVK_KHACH_HANG extends Model
{
    use HasFactory;

    protected $table = 'NVK_KHACH_HANG';
    protected $primaryKey = 'nvkMaKhachHang'; // Đảm bảo rằng nvkMaKhachHang là khóa chính

    protected $fillable = [
        'nvkMaKhachHang', 'nvkHoTenKhachHang', 'nvkEmail', 'nvkMatKhau', 
        'nvkDienThoai', 'nvkDiaChi', 'nvkNgayDangKy', 'nvkTrangThai'
    ];

    public $incrementing = false; // Nếu nvkMaKhachHang không tự tăng thì bạn cần đặt false
    public $timestamps = true;

    protected $dates = ['nvkNgayDangKy'];

 
}
