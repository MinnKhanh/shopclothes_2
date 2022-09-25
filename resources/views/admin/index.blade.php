@extends('layout.master')
@section('content')
    <div class="row px-xl-3">
        <div class="col-12">
            <h5 class="title position-relative text-dark text-uppercase mb-3">
                <span class="bg-secondary pe-3">Bảng điều khiển</span>
            </h5>
        </div>
        <div class="col-xxl-3 col-sm-4 col-12 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-body__info">
                        <h4>ProductCount</h4>
                        <span>Sản phẩm</span>
                    </div>
                    <i class="fas fa-box"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-center">
                    <a class="text-white" href="{{ route('admin.product.index') }}">
                        Xem chi tiết
                        <i class="fas fa-arrow-alt-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-4 col-12 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-body__info">
                        <h4>UserCount & Order</h4>
                        <span>Người dùng và Đơn hàng</span>
                    </div>
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-center">
                    <a class="text-white" href="{{ route('admin.customers.index') }}">
                        Xem chi tiết
                        <i class="fas fa-arrow-alt-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-4 col-12 mb-3">
            <div class="card bg-danger text-white">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-body__info">
                        <h4>Order Import</h4>
                        <span>Hóa đơn nhập</span>
                    </div>
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-center">
                    <a class="text-white" href="{{ route('admin.orderimport.index') }}">
                        Xem chi tiết
                        <i class="fas fa-arrow-alt-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-4 col-12 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-body__info">
                        <h4>Brand</h4>
                        <span>Nhãn hàng</span>
                    </div>
                    <i class="fas fa-coins"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-center">
                    <a class="text-white" href="{{ route('admin.brand.index') }}">
                        Xem chi tiết
                        <i class="fas fa-arrow-alt-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-4 col-12 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-body__info">
                        <h4>Statistical</h4>
                        <span>Thông kê</span>
                    </div>
                    <i class="fas fa-coins"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-center">
                    <a class="text-white" href="/Admin/Revenue">
                        Xem chi tiết
                        <i class="fas fa-arrow-alt-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-4 col-12 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-body__info">
                        <h4>Type</h4>
                        <span>Phân loại</span>
                    </div>
                    <i class="fas fa-coins"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-center">
                    <a class="text-white" href="{{ route('admin.type.index') }}">
                        Xem chi tiết
                        <i class="fas fa-arrow-alt-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-4 col-12">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-body__info">
                        <h4>Discount</h4>
                        <span>Khuyến Mại</span>
                    </div>
                    <i class="fas fa-coins"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-center">
                    <a class="text-white" href="{{ route('admin.discount.index') }}">
                        Xem chi tiết
                        <i class="fas fa-arrow-alt-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>



    {{-- <div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
        <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
                Admin
            </a></div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item" id="quanly">
                    <a class="nav-link" href="../Product/admin.php">
                        <i class="material-icons"></i>
                        <p>Quản Lý Sản Phẩm</p>
                    </a>
                </li>
                <li class="nav-item " id="hoadon">
                    <a class="nav-link" href="../HoaDon/ThongKeHoaDon.php">
                        <i class="material-icons"></i>
                        <p>Hóa Đơn</p>
                    </a>
                </li>
                <li class="nav-item " id="thongke">
                    <a class="nav-link" href="../HoaDon/Bieu-do-doanh-thu.php">
                        <i class="material-icons"></i>
                        <p>Thống Kê</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="../../index1.php">
                        <i class="material-icons"></i>
                        <p>Shop</p>
                    </a>
                </li>
            </ul>
        </div>
    </div> --}}
@endsection
