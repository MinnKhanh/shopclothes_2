@extends('layout.master')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-4">
            <h2 class="text-center my-4">Đăng ký</h2>
            <form action="" class = "d-flex flex-column">
                
            <input class="form-control rounded-0 shadow-none text-box single-line"  data-val-required="Vui lòng nhập dữ liệu cho trường này" id="TenDangNhap" name="TenDangNhap" placeholder="Tên đăng nhập" type="text" value="" />
            <span class="field-validation-valid text-danger mb-3" data-valmsg-for="TenDangNhap" data-valmsg-replace="true"></span>
            <input class="form-control rounded-0 shadow-none text-box single-line"  data-val-required="Vui lòng nhập dữ liệu cho trường này" id="TenNguoiDung" name="TenNguoiDung" placeholder="Tên người dùng" type="text" value="" />
            <span class="field-validation-valid text-danger mb-3" data-valmsg-for="TenNguoiDung" data-valmsg-replace="true"></span>
            <input class="form-control rounded-0 shadow-none text-box single-line"  data-val-required="Vui lòng nhập dữ liệu cho trường này" id="Email" name="Email" placeholder="Email" type="text" value="" />
            <span class="field-validation-valid text-danger mb-3" data-valmsg-for="Email" data-valmsg-replace="true"></span>
            <input class="form-control rounded-0 shadow-none text-box single-line"  data-val-required="Vui lòng nhập dữ liệu cho trường này" id="SoDienThoai" name="SoDienThoai" placeholder="Số điện thoại" type="text" value="" />
            <span class="field-validation-valid text-danger mb-3" data-valmsg-for="SoDienThoai" data-valmsg-replace="true"></span>
            <input class="form-control rounded-0 shadow-none"  data-val-required="Vui lòng nhập dữ liệu cho trường này" id="MatKhau" name="MatKhau" placeholder="Mật khẩu" type="password" value="" />
            <span class="field-validation-valid text-danger mb-3" data-valmsg-for="MatKhau" data-valmsg-replace="true"></span>         
                   
            <button class="btn btn-primary rounded-0 shadow-none mb-3">Đăng ký</button>
</form>
            <p class="text-center">Bạn đã có tài khoản? <a href="/User/Login" class="text-primary">Đăng nhập</a></p>
        </div>
    </div>
</div>
@endsection