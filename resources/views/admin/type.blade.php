@extends('layout.master')
@section('content')
    <div class="row px-xl-3">
    <div class="col-12">
        <h5 class="title position-relative text-dark text-uppercase mb-3">
            <span class="bg-secondary pe-3">Danh sách phân loại</span>
        </h5>
        <div class="custom-datatable bg-light p-30 table-responsive">
            <table id="classify-table" class="table table-bordered text-center">
                <thead class="align-middle table-dark">
                    <tr>
                        <th>Tee</th>
                        <th>Phân loại chính</th>
                        <th>Phân loại phụ</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                   @forelse ($typenav as $item)
                        <tr>
                            <td>MaPhanLoai</td>
                            <td>PhanLoaiChinh</td>
                            <td>PhanLoaiPhu</td>
                        </tr>
                   @empty
                       
                   @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection