<?php
use App\Http\Controllers\NVK_LOAI_SAN_PHAMcontroller;
use App\Http\Controllers\NVK_SAN_PHAMController;
use App\Http\Controllers\NVK_KHACH_HANGcontroller;
use App\Http\Controllers\NVK_DANH_SACH_QUAN_TRIController;
use App\Http\Controllers\NVK_HOA_DONController;
use App\Http\Controllers\NVK_CT_HOA_DONController;
use App\Http\Controllers\NVK_TIN_TUCController;
use App\Http\Controllers\nvk_LOGIN_USERController;
use App\Http\Controllers\nvk_SIGNUPController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//admins login
use App\Http\Controllers\NVK_QUAN_TRIController;
Route::get('admins/nvk-login',[NVK_QUAN_TRIController::class,'nvklogin'])->name('admins.nvklogin');
Route::post('/admins/nvk-login',[NVK_QUAN_TRIController::class,'nvkloginSubmit'])->name('admins.nvkloginSubmit');

# Admin Routes
Route::get('/nvk-admins', function() {
    return view('nvkAdmins.index');
});

#admins - danh muc--------------------------------------------------------------------------------------------------------------------------------------
Route::get('/nvk-admins/nvkdanhsachquantri/nvkdanhmuc', [NVK_DANH_SACH_QUAN_TRIController::class, 'danhmuc'])
->name('nvkAdmins.nvkdanhsachquantri.danhmuc');
#admins - tin tức --------------------------------------------------------------------------------------------------------------------------------------
Route::get('/nvk-admins/nvkdanhsachquantri/nvktintuc', [NVK_DANH_SACH_QUAN_TRIController::class, 'tintuc'])
->name('nvkAdmins.nvkdanhsachquantri.danhmuc.tintuc'); 
// Sản phẩm--------------------------------------------------------------------------------------------------------------------------------------
Route::get('/nvk-admins/nvkdanhsachquantri/nvksanpham', [NVK_DANH_SACH_QUAN_TRIController::class, 'sanpham'])
->name('nvkAdmins.nvkdanhsachquantri.danhmuc.sanpham');
// Mô tả sản phẩm--------------------------------------------------------------------------------------------------------------------------------------
Route::get('/nvk-admins/nvkdanhsachquantri/nvkmota/{id}', [NVK_DANH_SACH_QUAN_TRIController::class, 'mota'])
->name('nvkAdmins.nvkdanhsachquantri.danhmuc.mota');
#admins -Người dùng-------------------------------------------------------------------------------------------------------------------------------------
Route::get('/nvk-admins/nvkdanhsachquantri/nvknguoidung', [NVK_DANH_SACH_QUAN_TRIController::class, 'nguoidung'])
->name('nvkAdmins.nvkdanhsachquantri.nguoidung');

//xem loại sản phẩm 
Route::get('/nvk-admins/nvk-loai-san-pham',[NVK_LOAI_SAN_PHAMcontroller::class,'nvkList'])
->name('nvkadmins.nvkloaisanpham');

//thêm loại sản phẩm
Route::get('/nvk-admins/nvk-loai-san-pham/nvk-create',[NVK_LOAI_SAN_PHAMcontroller::class,'nvkCreate'])
->name('nvkadmins.nvkloaisanpham.nvkcreate');
Route::post('/nvk-admins/nvk-loai-san-pham/nvk-create',[NVK_LOAI_SAN_PHAMcontroller::class,'nvkCreateSubmit'])
->name('nvkadmins.nvkloaisanpham.nvkcreatesubmit');

//edit loại sản phẩm
Route::get('/nvk-admins/nvk-loai-san-pham/nvk-edit/{id}',[NVK_LOAI_SAN_PHAMcontroller::class,'nvkEdit'])
->name('nvkadmins.nvkloaisanpham.nvkedit');
Route::post('/nvk-admins/nvk-loai-san-pham/nvk-edit',[NVK_LOAI_SAN_PHAMcontroller::class,'nvkEditSubmit'])
->name('nvkadmins.nvkloaisanpham.nvkeditsubmit');

//view
Route::get('/nvk-admins/nvk-loai-san-pham/nvk-view/{id}',[NVK_LOAI_SAN_PHAMcontroller::class,'nvkView'])
->name('nvkadmins.nvkloaisanpham.nvkview');

// delete loại sản phẩm
Route::get('/nvk-admins/nvk-loai-san-pham/nvk-delete/{id}',[NVK_LOAI_SAN_PHAMController::class,'nvkDelete'])
->name('nvkadmins.nvkloaisanpham.nvkdelete');

//sản phẩm

// search
Route::get('/nvk-admins/vtd-san-pham/search', [NVK_SAN_PHAMController::class, 'searchAdmins'])->name('nvkuser.searchAdmins');
// list

Route::get('/nvk-admins/nvk-san-pham',[NVK_SAN_PHAMController::class,'nvkList'])
->name('nvkadims.nvksanpham');
//thêm loại sản phẩm
Route::get('/nvk-admins/nvk-san-pham/nvk-create',[NVK_SAN_PHAMController::class,'nvkCreate'])
->name('nvkadmins.nvksanpham.nvkcreate');
Route::post('/nvk-admins/nvk-san-pham/nvk-create',[NVK_SAN_PHAMController::class,'nvkCreateSubmit'])
->name('nvkadmins.nvksanpham.nvkCreateSubmit');

//xem sản phẩm
Route::get('/nvk-admins/nvk-san-pham/nvk-detail/{id}', [NVK_SAN_PHAMController::class, 'nvkDetail'])
->name('nvkadmins.nvksanpham.nvkDetail');
// edit
Route::get('/nvk-admins/nvk-san-pham/nvk-edit/{id}', [NVK_SAN_PHAMController::class, 'nvkEdit'])
->name('nvkadmins.nvksanpham.nvkEdit');
// Xử lý cập nhật sản phẩm
Route::post('/nvk-admins/nvk-san-pham/nvk-edit/{id}', [NVK_SAN_PHAMController::class, 'nvkEditSubmit'])
->name('nvkadmins.nvksanpham.nvkEditSubmit');
// Đảm bảo sử dụng phương thức POST để gọi route xóa sản phẩm
Route::get('/nvk-admins/nvk-san-pham/nvk-delete/{id}', [NVK_SAN_PHAMController::class, 'nvkdelete'])
->name('nvkadmins.nvksanpham.nvkdelete');

// Khách--------------------------------------------------------------------------------------------------------------------------------------
// list
Route::get('/nvk-admins/nvk-khach-hang',[nvk_KHACH_HANGcontroller::class,'nvkList'])
->name('nvkadmins.nvkkhachhang');
//detail
Route::get('/nvk-admins/nvk-khach-hang/nvk-detail/{id}', [nvk_KHACH_HANGcontroller::class, 'nvkDetail'])
->name('nvkadmin.nvkkhachhang.nvkDetail');
//create
Route::get('/nvk-admins/nvk-khach-hang/nvk-create',[nvk_KHACH_HANGcontroller::class,'nvkCreate'])
->name('nvkadmin.nvkkhachhang.nvkcreate');
Route::post('/nvk-admins/nvk-khach-hang/nvk-create',[nvk_KHACH_HANGcontroller::class,'nvkCreateSubmit'])
->name('nvkadmin.nvkkhachhang.nvkCreateSubmit');
//edit
Route::get('/nvk-admins/nvk-khach-hang/nvk-edit/{id}', [nvk_KHACH_HANGcontroller::class, 'nvkEdit'])
->name('nvkadmin.nvkkhachhang.nvkedit');
Route::post('/nvk-admins/nvk-khach-hang/nvk-edit/{id}', [nvk_KHACH_HANGcontroller::class, 'nvkEditSubmit'])
->name('nvkadmin.nvkkhachhang.nvkEditSubmit');
//delete
// Đảm bảo sử dụng phương thức POST để gọi route xóa sản phẩm
Route::get('/nvk-admins/nvk-khach-hang/nvk-delete/{id}', [nvk_KHACH_HANGcontroller::class, 'nvkDelete'])
->name('nvkadmin.nvkkhachhang.nvkdelete');

// Hóa Đơn--------------------------------------------------------------------------------------------------------------------------------------
// list
Route::get('/nvk-admins/nvk-hoa-don',[NVK_HOA_DONController::class,'nvkList'])
->name('nvkadmins.nvkhoadon');
//detail
Route::get('/nvk-admins/nvk-hoa-don/nvk-detail/{id}', [NVK_HOA_DONController::class, 'nvkDetail'])
->name('nvkadmin.nvkhoadon.nvkDetail');
//create
Route::get('/nvk-admins/nvk-hoa-don/nvk-create',[NVK_HOA_DONController::class,'nvkCreate'])
->name('nvkadmin.nvkhoadon.nvkcreate');
Route::post('/nvk-admins/nvk-hoa-don/nvk-create',[NVK_HOA_DONController::class,'nvkCreateSubmit'])
->name('nvkadmin.nvkhoadon.nvkCreateSubmit');
//edit
Route::get('/nvk-admins/nvk-hoa-don/nvk-edit/{id}', [NVK_HOA_DONController::class, 'nvkEdit'])
->name('nvkadmin.nvkhoadon.nvkedit');
Route::post('/nvk-admins/nvk-hoa-don/nvk-edit/{id}', [NVK_HOA_DONController::class, 'nvkEditSubmit'])
->name('nvkadmin.nvkhoadon.nvkEditSubmit');
//delete
// Đảm bảo sử dụng phương thức POST để gọi route xóa sản phẩm
Route::get('/nvk-admins/nvk-hoa-don/nvk-delete/{id}', [NVK_HOA_DONController::class, 'nvkDelete'])
->name('nvkadmin.nvkhoadon.nvkdelete');

// Chi Tiết Hóa Đơn--------------------------------------------------------------------------------------------------------------------------------------
// list
Route::get('/nvk-admins/nvk-ct-hoa-don',[NVK_CT_HOA_DONController::class,'nvkList'])
->name('nvkadmins.nvkcthoadon');
//detail
Route::get('/nvk-admins/nvk-ct-hoa-don/nvk-detail/{id}', [NVK_CT_HOA_DONController::class, 'nvkDetail'])
->name('nvkadmin.nvkcthoadon.nvkDetail');
//create
Route::get('/nvk-admins/nvk-ct-hoa-don/nvk-create',[NVK_CT_HOA_DONController::class,'nvkCreate'])
->name('nvkadmin.nvkcthoadon.nvkcreate');
Route::post('/nvk-admins/nvk-ct-hoa-don/nvk-create',[NVK_CT_HOA_DONController::class,'nvkCreateSubmit'])
->name('nvkadmin.nvkcthoadon.nvkCreateSubmit');
//edit
Route::get('/nvk-admins/nvk-ct-hoa-don/nvk-edit/{id}', [NVK_CT_HOA_DONController::class, 'nvkEdit'])
->name('nvkadmin.nvkcthoadon.nvkedit');
Route::post('/nvk-admins/nvk-ct-hoa-don/nvk-edit/{id}', [NVK_CT_HOA_DONController::class, 'nvkEditSubmit'])
->name('nvkadmin.nvkcthoadon.nvkEditSubmit');
//delete
// Đảm bảo sử dụng phương thức POST để gọi route xóa sản phẩm
Route::get('/nvk-admins/nvk-ct-hoa-don/nvk-delete/{id}', [NVK_CT_HOA_DONController::class, 'nvkDelete'])
->name('nvkadmin.nvkcthoadon.nvkdelete');


// Quản trị Viên--------------------------------------------------------------------------------------------------------------------------------------
// list
Route::get('/nvk-admins/nvk-quan-tri',[NVK_QUAN_TRIController::class,'nvkList'])
->name('nvkadmins.nvkquantri');
//detail
Route::get('/nvk-admins/nvk-quan-tri/nvk-detail/{id}', [NVK_QUAN_TRIController::class, 'nvkDetail'])
->name('nvkadmin.nvkquantri.nvkDetail');
//create
Route::get('/nvk-admins/nvk-quan-tri/nvk-create',[NVK_QUAN_TRIController::class,'nvkCreate'])
->name('nvkadmin.nvkquantri.nvkcreate');
Route::post('/nvk-admins/nvk-quan-tri/nvk-create',[NVK_QUAN_TRIController::class,'nvkCreateSubmit'])
->name('nvkadmin.nvkquantri.nvkCreateSubmit');
//edit
Route::get('/nvk-admins/nvk-quan-tri/nvk-edit/{id}', [NVK_QUAN_TRIController::class, 'nvkEdit'])
->name('nvkadmin.nvkquantri.nvkedit');
Route::post('/nvk-admins/nvk-quan-tri/nvk-edit/{id}', [NVK_QUAN_TRIController::class, 'nvkEditSubmit'])
->name('nvkadmin.nvkquantri.nvkEditSubmit');
//delete
// Đảm bảo sử dụng phương thức POST để gọi route xóa sản phẩm
Route::get('/nvk-admins/nvk-quan-tri/nvk-delete/{id}', [NVK_QUAN_TRIController::class, 'nvkDelete'])
->name('nvkadmin.nvkquantri.nvkdelete');

// Tin Tức--------------------------------------------------------------------------------------------------------------------------------------
// list
Route::get('/nvk-admins/nvk-tin-tuc',[NVK_TIN_TUCController::class,'nvkList'])
->name('nvkadmins.nvktintuc');
//detail
Route::get('/nvk-admins/nvk-tin-tuc/nvk-detail/{id}', [NVK_TIN_TUCController::class, 'nvkDetail'])
->name('nvkadmin.nvktintuc.nvkDetail');
//create
Route::get('/nvk-admins/nvk-tin-tuc/nvk-create',[NVK_TIN_TUCController::class,'nvkCreate'])
->name('nvkadmin.nvktintuc.nvkcreate');
Route::post('/nvk-admins/nvk-tin-tuc/nvk-create',[NVK_TIN_TUCController::class,'nvkCreateSubmit'])
->name('nvkadmin.nvktintuc.nvkCreateSubmit');
//edit
Route::get('/nvk-admins/nvk-tin-tuc/nvk-edit/{id}', [NVK_TIN_TUCController::class, 'nvkEdit'])
->name('nvkadmin.nvktintuc.nvkedit');
Route::post('/nvk-admins/nvk-tin-tuc/nvk-edit/{id}', [NVK_TIN_TUCController::class, 'nvkEditSubmit'])
->name('nvkadmin.nvktintuc.nvkEditSubmit');
//delete
// Đảm bảo sử dụng phương thức POST để gọi route xóa sản phẩm
Route::get('/nvk-admins/nvk-tin-tuc/nvk-delete/{id}', [NVK_TIN_TUCController::class, 'nvkDelete'])
->name('nvkadmin.nvktintuc.nvkdelete');




use App\Http\Controllers\HomeController;

// User - Routes
Route::get('/nvk-user', [HomeController::class, 'index'])->name('nvkuser.home');
Route::get('/nvk-user1', [HomeController::class, 'index1'])->name('nvkuser.home1');
// Hiển thị chi tiết sản phẩm
Route::get('/nvk-user/show/{id}', [HomeController::class, 'show'])->name('nvkuser.show');
// search
Route::get('/search', [NVK_SAN_PHAMController::class, 'search'])->name('nvkuser.search');
Route::get('/search1', [NVK_SAN_PHAMController::class, 'search1'])->name('nvkuser.search1');

Route::get('/nvkuser/login', [NVK_LOGIN_USERController::class, 'nvkLogin'])->name('nvkuser.login');
Route::post('/nvkuser/login', [NVK_LOGIN_USERController::class, 'nvkLoginSubmit'])->name('nvkuser.nvkLoginSubmit');
Route::get('/nvkuser/logout', [nvk_LOGIN_USERController::class, 'nvkLogout'])->name('nvkuser.logout');


// hỗ trợ 
route::get('/nvk-user/support',function()
{
    return view('nvkuser.support');
});

// signup
Route::get('/nvk-user/signup', [NVK_SIGNUPController::class, 'nvksignup'])->name('nvkuser.nvksignup');
Route::post('/nvk-user/signup', [NVK_SIGNUPController::class, 'nvksignupSubmit'])->name('nvkuser.nvksignupSubmit');



// Route để hiển thị sản phẩm trong trang thanh toán
Route::get('/nvk-user/thanvkoan/{product_id}', [NVK_CT_HOA_DONController::class, 'nvkthanvkoan'])->name('nvkuser.nvkthanvkoan');

// Route để xử lý thanh toán
Route::post('/nvk-user/thanvkoan', [NVK_CT_HOA_DONController::class, 'storeThanvkoan'])->name('nvkuser.storeThanvkoan');
// create hóa đơn user


// tạo bảng hóa đơn
Route::get('san-pham/{sanPham}', [NVK_CT_HOA_DONController::class, 'show'])->name('sanpham.show');
Route::post('mua-san-pham/{sanPham}', [NVK_CT_HOA_DONController::class, 'store'])->name('hoadon.store');

// xem bảng Hóa Đơn mới Tạo
Route::get('hoa-don/{hoaDonId}/san-pham/{sanPhamId}', [NVK_HOA_DONController::class, 'show'])->name('hoadon.show');



// tạo bảng chi tiết hóa đơn


// Route để tạo mới chi tiết hóa đơn
Route::get('/cthoadon/{hoaDonId}/{sanPhamId}', [nvk_CT_HOA_DONController::class, 'create'])->name('cthoadon.create');

// Route để lưu chi tiết hóa đơn
Route::post('/cthoadon/store', [nvk_CT_HOA_DONController::class, 'storecthoadon'])->name('cthoadon.storecthoadon');

// Route để hiển thị chi tiết hóa đơn
Route::get('/hoa-don-id/{hoaDonId}/san-pham-id/{sanPhamId}', [nvk_CT_HOA_DONController::class, 'cthoadonshow'])->name('cthoadon.cthoadonshow');


// giỏ hàng