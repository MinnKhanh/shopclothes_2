@extends('layout.master')
@section('content')
    <div class="row px-xl-3">
    <div class="col-12">
        <h5 class="title position-relative text-dark text-uppercase mb-3">
            <span class="bg-secondary pe-3">Bảng điều khiển</span>
        </h5>
    </div>
    <div class="col-xxl-3 col-sm-6 col-12 mb-3">
        <div class="card bg-primary text-white">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div class="card-body__info">
                    <h4>ProductCount</h4>
                    <span>Sản phẩm</span>
                </div>
                <i class="fas fa-box"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-center">
                <a class="text-white" href="/Admin/Product">
                    Xem chi tiết
                    <i class="fas fa-arrow-alt-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-6 col-12 mb-3">
        <div class="card bg-info text-white">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div class="card-body__info">
                    <h4>UserCount</h4>
                    <span>Người dùng</span>
                </div>
                <i class="fas fa-users"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-center">
                <a class="text-white" href="/Admin/User">
                    Xem chi tiết
                    <i class="fas fa-arrow-alt-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-6 col-12 mb-3">
        <div class="card bg-danger text-white">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div class="card-body__info">
                    <h4>OrderCount</h4>
                    <span>Đơn hàng</span>
                </div>
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-center">
                <a class="text-white" href="/Admin/Order">
                    Xem chi tiết
                    <i class="fas fa-arrow-alt-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-6 col-12">
        <div class="card bg-success text-white">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div class="card-body__info">
                    <h4>Revenue</h4>
                    <span>Doanh thu hôm nay</span>
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
</div>
@endsection