@extends('layout.master')
@section('content')
    <div class="row px-xl-3">
    <div class="col-12">
        <h5 class="title position-relative text-dark text-uppercase mb-3">
            <span class="bg-secondary pe-3">Danh sách khuyến mại</span>
        </h5>
        <div class="custom-datatable bg-light p-30 table-responsive">
            <table id="coupon-table" class="table table-bordered text-center">
                <thead class="align-middle table-dark">
                    <tr>
                        <th>Mã Khuyến mại</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Phần trăm giảm</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach (var couponItem in ViewBag.CouponList)
                    {
                        <tr>
                            <td>MaKM</td>
                            <td>NgayBatDau.ToString("dd/MM/yyyy")</td>
                            <td>NgayKetThuc.ToString("dd/MM/yyyy")</td>
                            <td>PhanTramGiam</td>
                        </tr>
                    }
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection