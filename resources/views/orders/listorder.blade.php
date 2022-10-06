@extends('layout.master')
@php
use App\Enums\StatusOrderEnum;
@endphp
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            height: 36px;
            border-radius: 0px;
        }

        .table-detail {
            width: 100%;
        }

        .img {
            width: 100px;
        }

        .modal-dialog {
            max-width: 661px !important;
            margin: 1.75rem auto;
        }

        .error {
            color: red !important;
        }

        .table th,
        .table td {
            padding: 20px 5px !important;
        }
    </style>
@endpush
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100px">
            <h1 class="font-weight-semi-bold text-uppercase">Hóa Đơn</h1>
        </div>
        <a href="{{ route('orders.export', ['id' => auth()->user()->id]) }}" type="submit"
            class="btn btn-primary mb-3 ml-5">Export</a>
    </div>
    <!-- Page Header End -->

    <table class="table container">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Tên Người Nhận</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Địa Chỉ</th>
                <th scope="col" class="text-center">Ngày Đặt Hàng</th>
                <th scope="col" class="text-center">Số Lượng</th>
                <th scope="col" class="text-center">Đơn Giá</th>
                <th scope="col" class="text-center">Phí Vận Chuyển</th>
                <th scope="col" class="text-center">Tình Trạng</th>
                <th scope="col" class="fix text-center"></th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @forelse ($orders as $item)
                <tr>
                    <td scope="col">{{ ++$i }}</td>
                    <td scope="col">{{ $item['name'] }}</td>
                    <td scope="col">{{ $item['email'] }}</td>
                    <td scope="col">{{ $item['address'] }}</td>
                    <td scope="col">{{ $item['created_at'] }}</td>
                    <td scope="col">{{ $item['quantity'] }}</td>
                    <td scope="col">{{ $item['price'] }}</td>
                    <td scope="col">{{ $item['ship'] }}</td>
                    <td scope="col">
                        <select name="status" id="status"
                            {{ auth()->user()->hasDirectPermission('Admin')? '': 'disabled' }} data-id={{ $item['id'] }}>
                            @foreach (StatusOrderEnum::getValues() as $itemsta)
                                <option {{ $item['status'] == $itemsta ? 'selected' : '' }} value="{{ $itemsta }}">
                                    {{ StatusOrderEnum::getStatus($itemsta) }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class=" d-flex justify-content-center flex-column">
                        {{-- <button type="button" class="btn btn-warning buttondetail" style="" data-id={{$item['id']}} data-toggle="modal" data-target="#modalbrand">Chi Tiết</button> --}}
                        <a class="btn btn-primary btn-sm shadow-none rounded-0 w-100 mb-1 buttondetail detail primary"
                            style="margin-right:10px" data-id={{ $item['id'] }} data-toggle="modal"
                            data-target="#modalbrand">Xem</a>
                        @if (auth()->check() && $item['status'] == 1)
                            <a class="btn btn-danger btn-sm shadow-none rounded-0 w-100 mb-1 delete"
                                style="margin-right:10px" data-id={{ $item['id'] }}>Xóa</a>
                        @endif
                        <form action="{{ route('orders.updateinfor', ['id' => $item['id'], 'iduser' => $iduser]) }}"
                            method="POST">
                            @csrf
                            <input type="text" name="id" value={{ $item['id'] }} class="d-none">
                            <input type="text" name="iduser" value={{ $iduser }} class="d-none">
                            <button class="btn btn-success btn-sm shadow-none rounded-0 w-100 mb-1 edit">Sửa</button>
                        </form>
                        {{-- <a href="{{ route('orders.updateinfor', ['id' => $item['id'], 'iduser' => $iduser]) }}"
                            class="edit" data-id={{ $item['id'] }}>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path
                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                            </svg></a> --}}
                    </td>

                </tr>
            @empty
            @endforelse
        </tbody>
    </table>

@endsection
@section('modal')
    <div class="modal fade" id="modalbrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Chi tiết hóa đơn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table-detail text-center table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tên Sản Phẩm</th>
                                <th scope="col">Màu</th>
                                <th scope="col">Size</th>
                                <th scope="col">Số Lượng</th>
                                <th scope="col">Đơn Giá</th>
                            </tr>
                        </thead>
                        <tbody id="listspdetail">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $('.buttondetail').click(function() {
                let id = $(this).attr('data-id')
                $.ajax({
                    url: "{{ route('orders.detail') }}",
                    type: 'GET',
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        console.log(response)
                        let inner = ''
                        response.forEach(element => {
                            inner += `<tr class='text-center itemproduct'>
                    <td><img src="{{ asset('storage') }}/${element.path}" class='img' alt=""></td>
                    <td>${element.name}</td>
                    <td>${element.sizename}</td>
                    <td>${element.colorname}</td>
                    <td>${element.quantity}</td>
                    <td>${element.totalPrice}</td>
                    </tr>
                    `
                        });
                        console.log(inner)
                        document.getElementById('listspdetail').innerHTML = inner
                    },
                    error: function(response) {

                    }
                });
            })
            $('.delete').click(function() {
                let id = $(this).attr('data-id')
                let ele = $(this)
                $.ajax({
                    url: "{{ route('orders.delete') }}",
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                    },
                    success: function(response) {
                        ele.parent().parent().remove()
                    },
                    error: function(response) {

                    }
                });
            })
            $('#status').change(function() {
                let status = $(this).val()
                let id = $(this).attr('data-id')
                console.log('data', status, id)
                $.ajax({
                    url: "{{ route('orders.updatestatus') }}",
                    type: 'PUT',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        status: status
                    },
                    success: function(response) {
                        console.log(response)
                    },
                    error: function(response) {

                    }
                });
            })
        </script>
    @endpush
