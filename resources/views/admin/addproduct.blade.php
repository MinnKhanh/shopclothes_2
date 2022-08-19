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
    </style>
@endpush
@section('content')

<form action="" class = "row px-xl-3" method="POST" enctype = "multipart/form-data">
 <div class="col-12">
        <h5 class="title position-relative text-dark text-uppercase mb-3">
            <span class="bg-secondary pe-3">Thông tin chung</span>
        </h5>
        <div class="bg-light p-30">
            <div class="row">
                <div class="col-md-4 form-group">
                    <label>Phân loại chính</label>
                    <select name="type" id="type" class = "form-control">
                        <option value="0">--Chọn--</option>
                        @foreach ($type as $item)
                            <option value={{$item['id']}}>{{$item['name']}}</option>
                        @endforeach
                    </select>
                </div>
                 <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-primary rounded-0 shadow-none mb-3" type="button" data-toggle="modal" data-target="#modaltype">Thêm Loại</button>
                </div>
                <div class="col-md-4 form-group">
                    <label>Phân loại phụ</label>
                    <select name="category" class = "form-control" id="category"></select>
                </div>
                  <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-primary rounded-0 shadow-none mb-3" type="button" data-toggle="modal" data-target="#modalcategory">Thêm Phân Loại</button>
                </div>
                <div class="col-md-6 form-group">
                    <label>Mã sản phẩm</label>
                    <input name="" id="" class = "form-control shadow-none rounded-0" placeholder = "AOKHOAC001">
                    <span class = "text-danger"></span>
                </div>
                <div class="col-md-6 form-group">
                    <label>Tên sản phẩm</label>
                    <input name="" id="" class = "form-control shadow-none rounded-0" placeholder = "Áo sơ mi dài tay khử mùi">
                    <span class = "text-danger"></span>
                </div>
                <div class="col-md-6 form-group">
                    <label>Giá nhập</label>
                     <input name="" id="" class = "form-control shadow-none rounded-0" placeholder = "100000">
                    <span class = "text-danger"></span>
                </div>
                <div class="col-md-6 form-group">
                    <label>Giá bán</label>
                     <input name="" id="" class = "form-control shadow-none rounded-0" placeholder = "300000">
                    <span class = "text-danger"></span>
                </div>
                <div class="col-md-6 form-group">
                    <label>Mô tả ngắn</label>
                    <input name="" id="" class = "form-control shadow-none rounded-0" placeholder = "Áo sơ mi dài tay với chất liệu khử mùi, co giãn tự nhiên">
                    <span class = "text-danger"></span>
                </div>
                <div class="col-md-6 form-group">
                    <label>Ảnh đại diện</label>
                    <input class = "form-control shadow-none rounded-0" type = "file">
                    <span class = "text-danger"></span>
                </div>
                 <div class="col-md-4 form-group">
                    <label>Nhãn Hiệu</label>
                    <select name="brand" class = "form-control" id="brand"></select>
                </div>
                 <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-primary rounded-0 shadow-none mb-3" type="button" data-toggle="modal" data-target="#modalbrand">Thêm Nhãn Hiệu</button>
                </div>
                <div class="col-md-3">
                    <label>Trạng thái</label>
                    <select class="form-control" name="TrangThai" id="TrangThai">
                        <option value="true">Hiển thị</option>
                        <option value="false">Ẩn</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Sản phẩm nổi bật</label>
                    <select class="form-control" name="NoiBat" id="NoiBat">
                        <option value="true">Có</option>
                        <option value="false">Không</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary rounded-0 shadow-none mt-3">Lưu sản phẩm</button>
                </div>
        </div>
        </div>
    </div>
</form>    
@endsection
@section('modal')
   <div class="modal fade" id="modaltype" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm Loại</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary">Thêm</button>
      </div>
    </div>
  </div>
</div>
 <div class="modal fade" id="modalcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm Phân Loại</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary">Thêm</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalbrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm Nhãn Hiệu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary">Thêm</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    $(document).on('change','#type',function(){
       $('#category').val(null).trigger('change');
    })
    $("#type").select2({
                ajax: {
                    url: '{{ route('api.type') }}',
                    data: function(params) {
                        const queryParameters = {
                            q: params.term
                        };

                        return queryParameters;
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
       
    $("#category").select2({
                    ajax: {
                        url: '{{ route('api.categories') }}',
                        data: function(params) {
                            const queryParameters = {
                                q: params.term,
                                type: $('#type').val()
                            };

                            return queryParameters;
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });
       
    </script>
@endpush