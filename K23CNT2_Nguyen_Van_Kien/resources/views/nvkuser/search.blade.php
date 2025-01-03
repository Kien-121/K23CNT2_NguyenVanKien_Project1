@extends('layouts.frontend.user')

@section('title', 'Trang Chủ')

@section('content-body')
<div class="container mx-auto mt-6 px-4">
    @if(isset($products) && $products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $sanpham)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition-all hover:scale-105 hover:shadow-xl">
                    <img src="{{ asset('storage/' . $sanpham->nhtHinhAnh) ?: asset('images/no-image.png') }}" class="w-full h-56 object-cover" alt="{{ $sanpham->nhtTenSanPham }}">
                    <div class="p-4">
                        <h5 class="text-lg font-semibold text-gray-800">{{ $sanpham->nhtTenSanPham }}</h5>
                        <p class="text-red-500 font-bold mt-2">{{ number_format($sanpham->nhtDonGia, 0, ',', '.') }} VND</p>
                        <p class="text-sm text-gray-600 mt-2"><small>Số lượng còn lại: {{ $sanpham->nhtSoLuong ?? 'Không xác định' }}</small></p>
                        <div class="mt-4">
                            <a href="{{ route('nhtuser.show', $sanpham->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded-md text-sm hover:bg-blue-600 transition duration-300 w-full block">
                                Xem Chi Tiết
                            </a>
                            
                                </a>
                                <button type="button" class="bg-yellow-500 text-white py-2 px-4 rounded-md text-sm hover:bg-yellow-600 transition duration-300 add-to-cart-btn" 
                                        data-id="{{ $sanpham->id }}" data-name="{{ $sanpham->nhtTenSanPham }}">
                                    <i class="fa fa-cart-plus"></i> Thêm vào giỏ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6 text-center flex justify-center">
            {{ $products->links() }}
        </div>
    @elseif(isset($search))
        <div class="mt-6 text-center text-red-500">
            <p class="text-lg">Không tìm thấy sản phẩm phù hợp với "{{ $search }}".</p>
        </div>
    @endif
</div>
@endsection
