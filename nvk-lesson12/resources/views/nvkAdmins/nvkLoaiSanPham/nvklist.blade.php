@extends('layouts.admins._master')
@section('title','Danh sach loai san pham')

@section('content-body')
    <div class="container border">
        <div class="row ">
            <div class="col-12">
                <div>
                <h1>Danh sach loai san pham</h1>
                <a href="{{route('nvkadmins.nvkloaisanpham.nvkcreate')}}" class="btn-success">them moi</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="cols ">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ma loai</th>
                        <th>Ten loai</th>
                        <th>Trang thai</th>
                        <th>Chuc nang</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($nvkLoaiSanPham as $item)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{$item->nvkMaLoai}}</td>
                        <td>{{$item->nvkTenLoai}}</td>
                        <td>{{$item->nvkTranThai}}</td>
                        <td>
                            view/ 
                            <a href="/nvkadmins/nvkloaisanpham/nvkedit',{{ $item->id }}">Edit</a>
                            / <a href="/nvkadmins/nvkloaisanpham/nvkDelete',{{ $item->id }}"
                                onclick="return confirm('ban co chac muon xoa khong?')">delete
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <th colspan="5">chua co thong tin loai san pham</th>
                    </tr>
                    @endempty
                </tbody>
            </table>
        </div>

    </div>
@endsection
