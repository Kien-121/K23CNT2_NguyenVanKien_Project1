@extends('layouts.admins._master')

@section('title','Them moi loai san pham')

@section('content-body')

   <div class="container border">
      <div class="row">
         <div class="col">
            <form action="{{ route('nvkadmins.nvkloaisanpham.nvkcreatesubmit') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h2>Them moi loai san pham</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="nvkMaLoai" class="col-sm-2 col-form-label">Ma Loai</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nvkMaLoai" name="nvkMaLoai" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nvkTenLoai" class="col-sm-2 col-form-label">Ten Loai</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nvkTenLoai" name="nvkTenLoai" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nvkTranThai" class="col-sm-2 col-form-label">Trang Thai</label>
                            <div class="col-sm-10">
                                <input type="radio" id="nvkTranThai" name="nvkTranThai" value="1" />
                                <label for="nvkTranThai">Hien thi</label>
                                <input type="radio" id="nvkTranThai" name="nvkTranThai" value="#" />
                              <label for="nvkTranThai">Khoa</label>
                            </div>
                        </div>

                        
                        </div>
                    </div>
                </div>
            </form>
         </div>
      </div>
   </div>



                                    
                              

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success">Ghi lai</button>
                        <a href="{{route('nvkadmins.nvkloaisanpham')}}" class="btn btn-secondary">Quay lai</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
   </div>

@endsection
