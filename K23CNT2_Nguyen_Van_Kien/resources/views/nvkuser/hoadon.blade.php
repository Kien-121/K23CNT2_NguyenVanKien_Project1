@extends('layouts.frontend.user1')

@section('title', 'Hóa Đơn')

@section('content-body')
<div class="container">
    <h1>Mua Sản Phẩm: {{ $sanPham->nhtTenSanPham }}</h1>

    <form action="{{ route('hoadon.store', ['sanPham' => $sanPham->id]) }}" method="POST">
        @csrf
        <!-- Các trường khách hàng -->
        <div class="mb-3">
            <label for="nhtMaKhachHang" class="form-label">Mã Khách Hàng</label>
            <input type="text" name="nhtMaKhachHang" value="{{ Session::get('nhtMaKhachHang', '') }}" class="form-control" required readonly>
        </div>

        <div class="mb-3">
            <label for="nhtHoTenKhachHang" class="form-label">Họ Tên Khách Hàng</label>
            <input type="text" name="nhtHoTenKhachHang" value="{{ Session::get('username1', '') }}" class="form-control" required readonly>
        </div>

        <div class="mb-3">
            <label for="nhtEmail" class="form-label">Email</label>
            <input type="email" name="nhtEmail" value="{{ Session::get('nhtEmail', '') }}" class="form-control" required readonly>
        </div>

        <div class="mb-3">
            <label for="nhtDienThoai" class="form-label">Số Điện Thoại</label>
            <input type="text" name="nhtDienThoai" value="{{ Session::get('nhtDienThoai', '') }}" class="form-control" required readonly>
        </div>

        <div class="mb-3">
            <label for="nhtDiaChi" class="form-label">Địa Chỉ</label>
            <input type="text" name="nhtDiaChi" value="{{ Session::get('nhtDiaChi', '') }}" class="form-control" required>
        </div>

        <!-- Chọn sản phẩm và số lượng -->
        <input type="hidden" name="nhtSanPhamId" value="{{ $sanPham->id }}" required>
        <div class="mb-3">
            <label for="nhtSoLuong" class="form-label">Số Lượng</label>
            <input type="number" name="nhtSoLuong" value="1" min="1" max="{{ $sanPham->nhtSoLuong }}" class="form-control" required>
        </div>

        <!-- Nút Mua -->
        <button type="submit" class="btn btn-primary">Mua Sản Phẩm</button>
        
    </form>
</div>
@endsection
