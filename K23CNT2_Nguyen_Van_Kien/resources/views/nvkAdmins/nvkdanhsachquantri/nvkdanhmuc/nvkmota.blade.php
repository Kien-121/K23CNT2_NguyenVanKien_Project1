@extends('layouts.admins._matster')
@section('title', 'Mô Tả Sản Phẩm')

@section('content-body')
    <div class="container-fluid mt-5">
        <h1 class="text-center text-primary mb-4" style="font-family: 'Roboto', sans-serif;">Mô Tả Sản Phẩm</h1>

        <div class="row">
            <div class="col-12">
                <!-- Sử dụng Flexbox để ảnh nhỏ hơn và mô tả nằm bên dưới -->
                <div class="text-center mb-4">
                    <!-- Hiển thị ảnh sản phẩm nhỏ hơn ở đầu -->
                    <div class="mb-3" style="max-width: 500px; margin: 0 auto;">
                        <img src="{{ asset('storage/' . $product->nvkHinhAnh) }}" class="img-fluid rounded" alt="Sản phẩm {{ $product->nvkMaSanPham }}" style="object-fit: cover; max-height: 400px;">
                    </div>
                    
                    <!-- Hiển thị tên sản phẩm ở dưới ảnh -->
                    <h3 class="mb-3" style="font-size: 2rem; color: #2c3e50; font-weight: bold;">
                        {{ $product->nvkTenSanPham }}
                    </h3>

                    <!-- Hiển thị thông tin sản phẩm bên dưới ảnh -->
                    <div class="d-flex flex-column px-3">
                        <p class="text-start mb-3" style="font-size: 1.2rem; color: #555; line-height: 1.6;">
                            <strong class="text-dark">Giới thiệu:</strong>
                            <span>{{ $product->nvkGioiThieu }}</span>
                        </p>

                        <p class="text-start mb-3" style="font-size: 1.2rem; color: #555; line-height: 1.6;">
                            <strong class="text-dark">Mô tả:</strong>
                            <span>{{ $product->nvkMoTa }}</span>
                        </p>

                        <p class="text-start" style="font-size: 1.2rem; color: red; line-height: 1.6; font-weight: bold;">
                            <strong class="text-dark">Giá:</strong> {{ number_format($product->nvkDonGia, 0, ',', '.') }} VND
                        </p>
                    </div>
                </div>
                <!-- Nút Quay lại trang trước -->
                <a href="javascript:history.back()" class="btn btn-outline-secondary mt-3">Quay lại trang trước</a>
            </div>
        </div> 
    </div>
@endsection
