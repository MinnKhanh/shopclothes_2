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
    
<form action="{{route('admin.product.storedetail')}}" id="fromDetail" class = "row px-xl-3" enctype = "multipart/form-data">
    @csrf
    <input type="text" name='idProduct' class="d-none" value="{{$id}}">
<div class="col-12">
        <h5 class="title position-relative text-dark text-uppercase mb-3 mt-3">
            <span class="bg-secondary pe-3">Thông tin phân loại</span>
        </h5>
        <div class="custom-datatable bg-light p-30 table-responsive">
            <div class="row mb-3">
                <div class="col-md-6 form-group row">
                    <div class="col-md-8 form-group">
                    <label>Màu sắc</label>
                    <select name="color" id="color" class = "form-control" id=""></select>
                    {{-- <div class="error">error</div> --}}
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-primary rounded-0 shadow-none mb-3" type="button" data-toggle="modal" data-target="#modalcolor">Thêm Màu</button>
                </div>
                </div>
                 <div class="col-md-2 form-group">
                    <label>Loại Kích Cỡ</label>
                      <select name="typesize" id="typesize" class = "form-control">
                        <option value=1>Chữ</option>
                        <option value=2>Số</option>
                      </select>
                </div>
                <div class="col-md-4 form-group">
                    <label>Kích cỡ</label>
                    <input class="form-control" name="size" id="size">
                    
                </div>
                <div class="col-md-6 form-group">
                    <label>Số lượng</label>
                    <input type="text" name="quantity" class = "form-control shadow-none rounded-0" placeholder = "Số lượng">
                   {{-- <div class="error">error</div> --}}
                </div>
                <div class="col-md-6 form-group">
                    <label>Ảnh phân loại</label>
                    <input type="file" name="photo[]" multiple  class = "form-control shadow-none rounded-0">
                   {{-- <div class="error">error</div> --}}
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary rounded-0 shadow-none mt-3 addDetail" type="button">Lưu phân loại</button>
                </div>
            </div>
            <table id="category-color-size-table" class="table table-bordered text-center">
                <thead class="align-middle table-dark">
                    <tr>
                        <th>Tên màu</th>
                        <th>Kích cỡ</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    
                </tbody>
            </table>
        </div>
    </div>
</form>
@endsection
@section('modal')
    {{-- Them Mau --}}
   <div class="modal fade" id="modalcolor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm Màu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="modal-body" id="formcolor" action="{{ route('admin.color.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        
         <div class="col-md-12 form-group mb-4">
            <label>Tên Màu</label>
            <input class = "form-control shadow-none rounded-0" id="namecolor" name="name" type = "text">
            <span class = "text-danger errorname"></span>
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary closetype" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="addcolor">Thêm</button>
      </div>
    </div>
  </div>
</div>
    {{-- Them Mau --}}

@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.28/dist/sweetalert2.all.min.js"></script>
    <script>
         $("#color").select2({
                    ajax: {
                        url: '{{ route('api.color') }}',
                        data: function(params) {
                            const queryParameters = {
                                q: params.term,
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
                 $("#size").select2({
                    ajax: {
                        url: '{{ route('api.size') }}',
                        data: function(params) {
                            const queryParameters = {
                                q: params.term,
                                type:$('#typesize').val()
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
     function sumitform(formData,obj){
        console.log(obj.attr('action'),'dd')
         $.ajax({
                url: obj.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                enctype: 'multipart/form-data',
                success: function(response) {
                    Swal.fire({
                    icon: 'success',
                    title: 'Thêm thành công',
                    showConfirmButton: false,
                    timer: 1500
                    })
                   obj.find('input').val(null)
                 obj.find('.text-danger').text('')
                 console.log(response)
                },
                error: function(response) {
                    object=response.responseJSON?response.responseJSON.errors:{}
                     for (const property in object) {
                        obj.find('.error'+property).text(object[property][0])
                    }
                }
            });
    }           
        $('#addcolor').click(function(){
        console.log('chay')
            const obj = $('#formcolor');
            const formData = new FormData(obj[0]);
           sumitform(formData,obj)
    })
    $('.addDetail').click(function(){
            const obj = $('#fromDetail');
            const formData = new FormData(obj[0]);
            $.ajax({
                url: obj.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                enctype: 'multipart/form-data',
                success: function(response) {
                    Swal.fire({
                    icon: 'success',
                    title: 'Thêm thành công',
                    showConfirmButton: false,
                    timer: 1500
                    })
                   obj.find('input').val(null)
                 obj.find('.text-danger').text('')
                },
                error: function(response) {
                    console.log(response)
                    object=response.responseJSON?response.responseJSON.errors:{}
                     for (const property in object) {
                        obj.find('.error'+property).text(object[property][0])
                    }
                }
            });
    })
    </script>
@endpush