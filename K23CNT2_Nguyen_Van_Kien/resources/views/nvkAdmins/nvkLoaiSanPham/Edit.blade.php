@extends('layouts.admins._matster')
@section('title'.'Sửa Thông Tin Sản Phẩm')

@section('content-body')
    <div class="container">
        <div class="row mt-3">
            <div  class="col"> 
                <form action="{{route('nvkadmins.nvkloaisanpham.nvkeditsubmit')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$nvkLoaiSanPham->id}}">
                    <div class="card">
                           <div class="card-header">
                                <h2>Sửa thông tin sản phẩm</h2>
                           </div>
                            <div class="card-body container-fluid">
                                <div class="mb-3 row">
                                        <label for="nvkMaLoai" class="col-sm-2 col-form-label">Mã Loại</label>
                                    <div class="col-sm-10">
                                         <input type="text" class="form-control" 
                                         value="{{$nvkLoaiSanPham->nvkMaLoai}}"
                                         id="nvkMaLoai" name="nvkMaLoai" />
                                        @error('nvkMaLoai')
                                            <span class="text-danger">{{ $message }}</span>  
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                        <label for="nvkTenLoai" class="col-sm-2 col-form-label">Tên Loại</label>
                                    <div class="col-sm-10">
                                         <input type="text" class="form-control"
                                         value="{{$nvkLoaiSanPham->nvkTenLoai}}" 
                                         id="nvkTenLoai" name="nvkTenLoai" />
                                         @error('nvkTenLoai')
                                            <span class="text-danger">{{ $message }}</span>  
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                        <label for="nvkTrangThai" class="col-sm-2 col-form-label">Trạng Thái</label>
                                    <div class="col-sm-10">
                                        @if($nvkLoaiSanPham->nvkTrangThai ===1)
                                                <input type="radio"
                                            id="nvkTrangThai1" name="nvkTrangThai" value="1" checked/>
                                            <label for="nvkTrangThai1">Còn Hàng</label>
                                                &nbsp;
                                            <input type="radio"
                                            id="nvkTrangThai0" name="nvkTrangThai" value="0"/>
                                            <label for="nvkTrangThai0">Đã Hết</label>

                                        @else
                                        <input type="radio"
                                            id="nvkTrangThai1" name="nvkTrangThai" value="1" />
                                            <label for="nvkTrangThai1">Còn Hàng</label>
                                                &nbsp;
                                            <input type="radio"
                                            id="nvkTrangThai0" name="nvkTrangThai" value="0" checked/>
                                            <label for="nvkTrangThai0">Đã Hết</label>
                                        @endif
                                    </div>
                                </div>
                            </div>

                           <div class="card-footer">
                                <button class="btn btn-success">Ghi lại</button>
                                <a href="{{route('nvkadmins.nvkloaisanpham')}}" class="btn btn-secondary">Quay Lại</a>
                           </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection