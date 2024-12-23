@extends('layouts.admins._master')

@section('title', 'Sua thong tin loai san pham')

@section('content-body')

   <div class="container border">
      <div class="row">
         <div class="col">
            <form action="{{ route('nvkadmins.nvkloaisanpham.nvkeditSubmit', $nvkLoaiSanPham->id) }}" method="post">
                @csrf
                @method('PUT')  <!-- Laravel method spoofing to use PUT for updates -->
                
                <!-- Hidden ID field -->
                <input type="hidden" name="id" id="id" value="{{ $nvkLoaiSanPham->id }}">

                <div class="card">
                    <div class="card-header">
                        <h2>Sua thong tin loai san pham</h2>
                    </div>
                    <div class="card-body">

                        <div class="mb-3 row">
                            <label for="nvkMaLoai" class="col-sm-2 col-form-label">Ma Loai</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nvkMaLoai" name="nvkMaLoai" value="{{ $nvkLoaiSanPham->nvkMaLoai }}" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nvkTenLoai" class="col-sm-2 col-form-label">Ten Loai</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nvkTenLoai" name="nvkTenLoai" value="{{ $nvkLoaiSanPham->nvkTenLoai }}" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nvkTranThai" class="col-sm-2 col-form-label">Trang Thai</label>
                            <div class="col-sm-10">
                                <input type="radio" id="nvkTranThai1" name="nvkTranThai" value="1" {{ $nvkLoaiSanPham->nvkTranThai == 1 ? 'checked' : '' }} />
                                <label for="nvkTranThai1">Hien thi</label>

                                <input type="radio" id="nvkTranThai0" name="nvkTranThai" value="0" {{ $nvkLoaiSanPham->nvkTranThai == 0 ? 'checked' : '' }} />
                                <label for="nvkTranThai0">Khoa</label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-success">Ghi lai</button>
                    <a href="{{ route('nvkadmins.nvkloaisanpham') }}" class="btn btn-secondary">Quay lai</a>
                </div>
            </form>
         </div>
      </div>
   </div>

@endsection
