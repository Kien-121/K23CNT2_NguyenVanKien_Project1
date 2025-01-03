<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NVK_QUAN_TRI extends Model
{
    use HasFactory;
     // Chỉ định bảng của model nếu tên bảng khác tên mặc định
    protected $table="NVK_QUAN_TRI";
     // Chỉ định các cột có thể gán (mass assignable)
     protected $fillable = ['nvkTaiKhoan', 'nvkMatKhau', 'nvkTrangThai'];

     // Tắt timestamp nếu không cần
     public $timestamps = false;
}
