@extends('layout.master')
@section('content')
    <div class="row px-xl-3">
    <div class="col-12">
        <h5 class="title position-relative text-dark text-uppercase mb-3">
            <span class="bg-secondary pe-3">Danh sách người dùng</span>
        </h5>
        <div class="custom-datatable bg-light p-30 table-responsive">
            <table id="user-table" class="table table-bordered text-center">
                <thead class="align-middle table-dark">
                    <tr>
                        <th>Tên đăng nhập</th>
                        <th>Mật khẩu</th>
                        <th>Thông tin khác</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    {{-- @foreach (var in ViewBag.UserList)
                    { --}}
                        <tr>
                            <td> TenDangNhap</td>
                            <td> MatKhau</td>
                            <td>
                                - Tên người dùng:  TenNguoiDung <br>
                                - Số điện thoại:  SoDienThoai <br>
                                - Email:  Email <br>
                                - Địa chỉ:  DiaChi <br>
                            </td>
                        </tr>
                    {{-- } --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection