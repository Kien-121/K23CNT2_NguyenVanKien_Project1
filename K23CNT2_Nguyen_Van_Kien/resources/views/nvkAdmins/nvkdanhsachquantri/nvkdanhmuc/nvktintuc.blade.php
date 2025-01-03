@extends('layouts.admins._matster')

@section('title', 'Danh Sách Tin Tức')

@section('content-body')
    <div class="container mt-5">
        <h1 class="text-center mb-5">Danh Sách Tin Tức</h1>

        @if ($nhttintucs->isEmpty())
            <p class="text-center text-muted">Không có tin tức nào để hiển thị.</p>
        @else
            <div class="row">
                @foreach ($nhttintucs as $article)
                    <div class="col-md-4 mb-4 d-flex">
                        <div class="card shadow-sm border-light rounded d-flex flex-column">
                            <!-- Image Section -->
                            <img src="{{ $article->nvkHinhAnh ? asset('storage/' . $article->nvkHinhAnh) : asset('storage/default-image.jpg') }}" 
                                class="card-img-top rounded-top" 
                                alt="{{ $article->nvkTieuDe }}">

                            <div class="card-body d-flex flex-column">
                                <!-- Title -->
                                <h5 class="card-title mb-3" style="font-size: 1.25rem; font-weight: bold;">{{ $article->nvkTieuDe }}</h5>
                                
                                <!-- Description -->
                                <p class="card-text" style="font-size: 0.9rem; color: #555;">{{ Str::limit($article->nvkMoTa, 120) }}</p>
                                
                                <!-- Button -->
                                <a href="{{ route('nvkadmin.nvktintuc.nvkDetail', $article->id) }}" class="btn btn-primary btn-sm mt-2">Xem Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $nhttintucs->links('pagination::bootstrap-4') }}
            </div>
        @endif

        <!-- Back Button -->
        <div class="text-center mt-4">
        <a href="javascript:history.back()" class="btn btn-outline-secondary mt-3" style="color: black;">Quay lại trang trước</a>
        </div>
    </div> 
@endsection
