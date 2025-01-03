@extends('layouts.admins._matster')
@section('title'.'Thêm mới sản phẩm')
    
@section('content-body')
    <div class="container border">
        <div class="row">
            <div class="col">
                <form action="{{route('nvkadmins.nvksanpham.nvkCreateSubmit')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h1>Thêm Mới sản phẩm</h1>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nvkMaSanPham" class="form-label">Mã sản phẩm</label>
                                <input type="text" class="form-control" id="nvkMaSanPham" name="nvkMaSanPham" value="{{ old('nvkMaSanPham') }}" >
                                @error('nvkMaSanPham')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nvkTenSanPham" class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="nvkTenSanPham" name="nvkTenSanPham" value="{{ old('nvkTenSanPham') }}" >
                                @error('nvkTenSanPham')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="nvkHinhAnh" class="form-label">Hình Ảnh</label>
                                <input type="file" class="form-control" id="nvkHinhAnh" name="nvkHinhAnh" accept="image/*">
                                @error('nvkHinhAnh')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            

                            <div class="mb-3">
                                <label for="nvkSoLuong" class="form-label">Số Lượng</label>
                                <input type="number" class="form-control" id="nvkSoLuong" name="nvkSoLuong" value="{{ old('nvkSoLuong') }}" >
                                @error('nvkSoLuong')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nvkDonGia" class="form-label">Đơn Giá</label>
                                <input type="number" class="form-control" id="nvkDonGia" name="nvkDonGia" value="{{ old('nvkDonGia') }}" >
                                @error('nvkDonGia')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nvkMaLoai" class="form-label">Loại Danh Muc</label>
                                <select name="nvkMaLoai" id="nvkMaLoai" class="form-control">
                                    @foreach ($nvkloaisanpham as $item)
                                        <option value="{{ $item->id }}">{{ $item->nvkTenLoai }}</option>
                                    @endforeach
                                </select>
                                @error('nvkMaLoai')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            

                            <div class="mb-3">
                                <label for="nvkTrangThai" class="form-label">Trạng Thái</label>
                                <div class="col-sm-10">
                                    <input type="radio" id="nvkTrangThai1" name="nvkTrangThai" value="0" checked/>
                                    <label for="nvkTrangThai1"> Hiển Thị</label>
                                    &nbsp;
                                    <input type="radio" id="nvkTrangThai0" name="nvkTrangThai" value="1"/>
                                    <label for="nvkTrangThai0">Khóa</label>
                                </div>
                                @error('nvkTrangThai')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success">Thêm mới</button>
                            <a href="{{route('nvkadims.nvksanpham')}}" class="btn btn-primary"> Quay Lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
