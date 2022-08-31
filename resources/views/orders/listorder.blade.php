@extends('layout.master')
@push('css')
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <style>
        .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    height: 36px;
    border-radius: 0px;
}
.error{
    color: red !important;
}
    </style>
@endpush
@section('content')
     <!-- Page Header Start -->
     <div class="container-fluid bg-secondary">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100px">
            <h1 class="font-weight-semi-bold text-uppercase">Hóa Đơn</h1>
        </div>
    </div>
    <!-- Page Header End -->
    <table class="table container">
    <thead class="thead-dark">
      <tr>
        <th scope="col"></th>
        <th scope="col">Tên Người Nhận</th>
        <th scope="col">Email</th>
        <th scope="col">Địa Chỉ</th>
        <th scope="col">Ngày Đặt Hàng</th>
        <th scope="col">Số Lượng</th>
        <th scope="col">Đơn Giá</th>
        {{-- <th scope="col">Phí Vận Chuyển</th> --}}
        <th scope="col">Tình Trạng</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        @php
            $i=0;
        @endphp
        @forelse ($orders as $item)
            <tr>
                <td scope="col">{{++$i}}</td>
                <td scope="col">{{$item['name']}}</td>
                <td scope="col">{{$item['email']}}</td>
                <td scope="col">{{$item['address']}}</td>
                <td scope="col">{{$item['created_at']}}</td>
                <td scope="col">{{$item['quantity']}}</td>
                <td scope="col">{{$item['price']}}</td>
                {{-- <td scope="col">{{$item['ship']}}</td> --}}
                <td scope="col">{{$item['status']}}</td>
                <td>
                <button type="button" class="btn btn-warning chitiet" data-id="" data-toggle="modal" data-target="#exampleModal">Chi Tiết</button>
                </td>
            </tr>        
        @empty
            
        @endforelse
  </tbody>
</table> 
<!-- dialog chi tiet -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table container">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Tên Sản Phẩm</th>
        <th scope="col">Size</th>
        <th scope="col">Số Lượng</th>
        <th scope="col">Đơn Giá</th>
        <th scope="col">Tổng Tiền</th>
      </tr>
    </thead>
    <tbody id="bodydetail">
    </tbody>
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 
@endsection
@section('modal')
    <div class="modal fade" id="modalbrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm Nhãn Hiệu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="modal-body" id="formbrand" action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        
         <div class="col-md-12 form-group mb-4">
            <label>Tên Loại</label>
            <input class = "form-control shadow-none rounded-0" id="namebrand" name="name" type = "text">
            <span class = "text-danger errorname"></span>
        </div>
         <div class="col-md-12 form-group mb-4">
            <label>Quốc gia</label>
            <select class = "form-control shadow-none rounded-0" id="country" name="country" type = "text">

            </select>
            <span class = "text-danger errorcountry"></span>
        </div>
         <div class="col-md-12 form-group mb-4">
            <label>Mô Tả</label>
            <textarea class = "form-control shadow-none rounded-0" id="mota" name="description" type = "text"></textarea>
            <span class = "text-danger errordescription"></span>
        </div>
        <div class="col-md-12 row form-group">
            <div class="col-md-8 form-group">
            <label>Ảnh</label>
            <input class = "form-control shadow-none rounded-0  file-img" name="photo" id="photobrand" type = "file">
            <span class ="text-danger errorphoto"></span>
            </div>
            <div class="col-md-4 form-group">
            <img style="width:100px; height:100%;" src="" class="imgchange" id="imgtype"/>
         </div>
        </div>
         
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary closebrand" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary addbrand">Thêm</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
       
    </script>
@endpush