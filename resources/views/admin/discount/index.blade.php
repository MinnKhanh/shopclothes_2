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
                            <th>Mô tả</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($discount as $item)
                            <th>{{ $item['code'] }}</th>
                            <th>{{ $item['begin'] }}</th>
                            <th>{{ $item['end'] }}</th>
                            <th>{{ $item['persent'] }}</th>
                            <th>{{ $item['discription'] }}</th>
                            <th>
                                <a href="{{ route('admin.brand.update', ['id' => $item['id']]) }}"
                                    class="btn btn-primary btn-sm mb-2 d-block buttonchange">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg> Chỉnh sửa
                                </a>
                                <button type="button" class="btn btn-danger btn-sm mb-2 d-block buttonchange remove"
                                    data-id={{ $item['id'] }}>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg> Xóa phân loại
                                </button>
                            </th>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
