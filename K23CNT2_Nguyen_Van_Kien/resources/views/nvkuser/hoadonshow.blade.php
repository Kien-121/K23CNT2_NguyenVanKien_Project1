    @extends('_layouts.frontend.user1')  <!-- Hoặc layout của bạn -->

    @section('title', 'Thông Tin Hóa Đơn')

    @section('content-body')
    <div class="container">
        <h1>Thông Tin Hóa Đơn</h1>
        
        <div class="card">
            <div class="card-header">
                <h3>Hóa Đơn ID: {{ $hoaDon->nhtMaHoaDon }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Tên Khách Hàng:</strong> {{ $hoaDon->nhtHoTenKhachHang }}</p>
                <p><strong>Email:</strong> {{ $hoaDon->nhtEmail }}</p>
                <p><strong>Số Điện Thoại:</strong> {{ $hoaDon->nhtDienThoai }}</p>
                <p><strong>Địa Chỉ:</strong> {{ $hoaDon->nhtDiaChi }}</p>
                <p><strong>Tổng Giá Trị:</strong> {{ number_format($hoaDon->nhtTongGiaTri, 0, ',', '.') }} VND</p>
                <p><strong>Ngày Hóa Đơn:</strong> {{ $hoaDon->nhtNgayHoaDon }}</p>
                <p><strong>Ngày Nhận:</strong> {{ $hoaDon->nhtNgayNhan }}</p>
                <p><strong>Trạng Thái:</strong> 
                    @if ($hoaDon->nhtTrangThai == 0)
                        Chưa Thanh Toán
                    @elseif ($hoaDon->nhtTrangThai == 1)
                        Đã Thanh Toán
                    @endif
                </p>
            </div>
            <a href="{{ route('cthoadon.create', ['hoaDonId' => $hoaDon->id, 'sanPhamId' => $sanPham->id]) }}">Xem chi tiết hóa đơn</a>

        </div>
    </div>

    @endsection
