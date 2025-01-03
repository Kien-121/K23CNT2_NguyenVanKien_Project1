<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Đăng Ký</title>
    <style>
        body {
            background-color: #f8f9fa; /* Light background for the entire page */
        }
        .form-container {
            background-color: #ffffff; /* White background for the form */
            border-radius: 8px; /* Rounded corners for the form */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for the form */
            padding: 30px; /* Padding inside the form */
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group .is-invalid {
            border-color: #e74a3b;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="form-container">
        <h2 class="text-center mb-4">Đăng Ký</h2>

        <!-- Display errors from backend if validation fails -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('nhtuser.nhtsignupSubmit') }}">
            @csrf

            <div class="form-group mb-3">
                <label for="nhtHoTenKhachHang">Họ và Tên</label>
                <input type="text" class="form-control @error('nhtHoTenKhachHang') is-invalid @enderror" 
                       id="nhtHoTenKhachHang" name="nhtHoTenKhachHang" value="{{ old('nhtHoTenKhachHang') }}" required>
                @error('nhtHoTenKhachHang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="nhtEmail">Email</label>
                <input type="email" class="form-control @error('nhtEmail') is-invalid @enderror" 
                       id="nhtEmail" name="nhtEmail" value="{{ old('nhtEmail') }}" required>
                @error('nhtEmail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="nhtMatKhau">Mật Khẩu</label>
                <input type="password" class="form-control @error('nhtMatKhau') is-invalid @enderror" 
                       id="nhtMatKhau" name="nhtMatKhau" required>
                @error('nhtMatKhau')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="nhtDienThoai">Số Điện Thoại</label>
                <input type="text" class="form-control @error('nhtDienThoai') is-invalid @enderror" 
                       id="nhtDienThoai" name="nhtDienThoai" value="{{ old('nhtDienThoai') }}" required>
                @error('nhtDienThoai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="nhtDiaChi">Địa Chỉ</label>
                <input type="text" class="form-control @error('nhtDiaChi') is-invalid @enderror" 
                       id="nhtDiaChi" name="nhtDiaChi" value="{{ old('nhtDiaChi') }}" required>
                @error('nhtDiaChi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100">Đăng Ký</button>
        </form>

        <div class="mt-3 text-center">
            <p>Đã có tài khoản? <a href="{{ route('nhtuser.login') }}">Đăng nhập</a></p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
