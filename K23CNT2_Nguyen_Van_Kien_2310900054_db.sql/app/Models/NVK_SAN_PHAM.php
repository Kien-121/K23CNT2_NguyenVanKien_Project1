<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NVK_SAN_PHAM extends Model
{
    use HasFactory;

    protected $table = 'NVK_SAN_PHAM';
    protected $primaryKey = 'id';
    public $incrementing = false; // Nếu nvknhacc không phải là auto-increment
    public $timestamps = true; // Đảm bảo là 'true' nếu bạn sử dụng timestamps
}