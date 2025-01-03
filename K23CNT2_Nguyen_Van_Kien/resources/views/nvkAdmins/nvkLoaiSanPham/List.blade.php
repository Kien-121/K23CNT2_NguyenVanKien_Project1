@extends('layouts.admins._matster')
@section('title'.'Danh sách loại sản phẩm')

@section('content-body')
    <div class="container">
        <div class="row">
            <div class="col-12">    
                <h1>Danh sách loại sản phẩm</h1>
                    <a href="{{route('nvkadmins.nvkloaisanpham.nvkcreate')}}" type="button" class="btn btn-success btn-lg">Thêm mới</a>
                </div>
        </div>
        <div class="row mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã Loại</th>
                        <th>Tên Loại</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th> 
                    </tr>
                </thead>
                <tbody>
                    @forelse ( $nvkLoaiSanPham as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$item->nvkMaLoai}}</td>
                        <td>{{$item->nvkTenLoai}}</td> 
                        <td>{{$item->nvkTrangThai}}</td>
                        <td>
                            
                            <a href="/nvk-admins/nvk-loai-san-pham/nvk-view/{{$item->id}}"type="button" class="btn btn-success btn-sm">
                            Xem</a>

                            <a href="/nvk-admins/nvk-loai-san-pham/nvk-edit/{{$item->id}}" type="button" class="btn btn-primary btn-sm">
                            Sửa</a>
                        
                            <a href="/nvk-admins/nvk-loai-san-pham/nvk-delete/{{$item->id}}"type="button" class="btn btn-danger btn-sm"
                            onclick="return confirm('Bạn có chắc muốn xóa không ?')">
                            Xóa</a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Chưa có thông tin sản phẩm</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection