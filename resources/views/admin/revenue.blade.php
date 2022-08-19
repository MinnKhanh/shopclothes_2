@extends('layout.master')
@section('content')
    <div class="row px-xl-3">
    <div class="col-12">
        <h5 class="title position-relative text-dark text-uppercase mb-3">
            <span class="bg-secondary pe-3">Doanh thu</span>
        </h5>
        <div class="custom-datatable bg-light p-30 table-responsive">
            <table id="revenue-table" class="table table-bordered text-center">
                <thead class="align-middle table-dark">
                    <tr>
                        <th colspan="4" class="bg-light text-dark text-center">Doanh thu: SumRevenue</th>
                    </tr>
                    <tr>
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Số tiền</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    
                        {{-- foreach (var revenueItem in ViewBag.RevenueList)
                        { --}}
                            <tr>
                                <td>i</td>
                                <td>MaDonHang</td>
                                <td>TenKhachHang</td>
                                <td>TongTien</td>
                            </tr>
                        {{-- } --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection