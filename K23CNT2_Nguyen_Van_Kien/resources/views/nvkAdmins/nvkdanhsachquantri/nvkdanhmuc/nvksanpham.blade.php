@extends('layouts.admins._matster')

@section('title', 'Danh Mục Sản Phẩm')

@section('content-body')
    <div class="container mt-4">
        <h1 class="mb-4 text-center text-primary">Danh Mục Sản Phẩm</h1>

        <div class="row d-flex align-items-stretch">
            @foreach($nhtsanphams as $plant)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-light h-100">
                        <!-- Điều chỉnh chiều cao ảnh và làm cho ảnh dài hơn -->
                        <img src="{{ asset('storage/' . $plant->nvkHinhAnh) }}" alt="Sản phẩm {{ $plant->nvkMaSanPham }}" class="card-img-top" style="height: 350px; object-fit: cover;">
                        <div class="card-body d-flex flex-column justify-content-center text-center">
                            <h5 class="card-title text-dark" style="font-family: 'Roboto', sans-serif;">{{ $plant->nvkTenSanPham }}</h5>
                            <p class="card-text" style="font-size: 1rem; color: #333;"><strong>Giá:</strong> {{ number_format($plant->nvkDonGia, 0, ',', '.') }} VND</p>
                            <!-- Thêm id vào link để hiển thị mô tả -->
                            <a href="{{ route('nvkAdmins.nvkdanhsachquantri.danhmuc.mota', ['id' => $plant->id]) }}" class="btn btn-primary mt-2">Mô Tả</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Back Button -->
        <div class="text-center mt-4">
        <a href="javascript:history.back()" class="btn btn-outline-secondary mt-3" style="color: black;">Quay lại trang trước</a>
        </div>
    </div>
@endsection