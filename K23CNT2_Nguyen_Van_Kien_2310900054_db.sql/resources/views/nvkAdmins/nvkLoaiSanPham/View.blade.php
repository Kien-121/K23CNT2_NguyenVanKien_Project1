@extends('layouts.admins._matster')

@section('title', 'Chi tiết loại sản phẩm')

@section('content-body')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Chi tiết loại sản phẩm</h1>
                <a href="{{ route('nvkadmins.nvkloaisanpham') }}" class="btn btn-primary">Quay lại danh sách</a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <table class="table table-bordered">
                    <tr>
                        <th>Mã Loại</th>
                        <td>{{ $nvkLoaiSanPham->nvkMaLoai }}</td>
                    </tr>
                    <tr>
                        <th>Tên Loại</th>
                        <td>{{ $nvkLoaiSanPham->nvkTenLoai }}</td>
                    </tr>
                    <tr>
                        <th>Trạng Thái</th>
                        <td>{{ $nvkLoaiSanPham->nvkTrangThai == 1 ? 'Còn Hàng' : 'Đã Hết' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
