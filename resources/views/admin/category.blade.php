@extends('layout.master')
@push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script> --}}
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
                    <select name="color" id="color" class = "form-control color"></select>
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
                    <select class="form-control size" name="size" id="size"></select>
                    
                </div>
                <div class="col-md-6 form-group">
                    <label>Số lượng</label>
                    <input type="text" name="quantity" id="quantity" class = "form-control shadow-none rounded-0" placeholder = "Số lượng">
                   {{-- <div class="error">error</div> --}}
                </div>
                <div class="col-md-6 form-group">
                    <label>Ảnh phân loại</label>
                    <input type="file" name="photo[]" multiple id="photo" class = "form-control shadow-none rounded-0">
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
                        <th></th>
                    </tr>
                </thead>
                <tbody class="align-middle" id="body">
                    @forelse ($list as $item)
                        <tr>
                            <td>{{$item['color_product']['name']}}</td>
                            <td>{{$item['size_product']['name']}}</td>
                            <td>{{$item['quantity']}}</td>
                            <th class="text-center">
                                <div data-toggle="modal" data-target="#modalupdate" data-id={{$item['id']}} class="btn btn-primary btn-xs m-r-5 update" data-toggle="tooltip"
                                    data-original-title="Sửa"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg></div>
                                <div data-id={{$item['id']}} data-toggle="modal" data-target="#deleteModal"
                                    class="btn btn-danger delete-category btn-xs m-r-5 remove"
                                    data-toggle="tooltip" data-original-title="Xóa"><i class="fa fa-trash font-14"></i></div>
                            </th>
                        </tr>
                    @empty
                        <tr>Chưa có dữ liệu</tr>
                    @endforelse
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
 {{-- Update --}}
   <div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Chỉnh Sửa Chi Tiết</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="modal-body" id="formupdate" action="{{ route('admin.product.storedetail') }}" method="post" enctype="multipart/form-data">
        @csrf
             <input type="text" name='idProduct' class="d-none" value="{{$id}}">
            <input type="text" id="idUpdate" name='id' class="d-none">
           <div class="container-fluid row mb-3">
                <div class="col-md-12 form-group row">
                    <div class="col-md-8 form-group">
                    <label>Màu sắc</label>
                    <select name="color" id="colorUpdate" style="width: 100%" class = "form-control color"></select>
                    {{-- <div class="error">error</div> --}}
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-primary rounded-0 shadow-none mb-3" type="button" data-toggle="modal" data-target="#modalcolor">Thêm Màu</button>
                    </div>
                </div>
                 <div class="col-md-3 form-group">
                    <label>Cỡ Bằng</label>
                      <select name="typesize" id="typeSizeUpdate" class = "form-control">
                        <option value=1>Chữ</option>
                        <option value=2>Số</option>
                      </select>
                </div>
                <div class="col-md-4 form-group">
                    <label>Kích cỡ</label>
                    <select class="form-control size" name="size" style="width: 100%" id="sizeUpdate"></select>
                    
                </div>
                <div class="col-md-5 form-group" id="sl">
                    <label>Số lượng</label>
                    <input type="text" name="quantity" id="quantityUpdate" class = "form-control shadow-none rounded-0" placeholder = "Số lượng">
                   {{-- <div class="error">error</div> --}}
                </div>
                {{-- <div class="col-md-6 form-group">
                    <label>Ảnh phân loại</label>
                    <input type="file" name="photo[]" multiple id="photo" class = "form-control shadow-none rounded-0">
                   
                </div> --}}
                <input type="number" id="numberImg" name='numberimg' class="d-none">
               
            </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary closetype" data-dismiss="modal">Đóng</button>
        <button class="btn btn-primary rounded-0 shadow-none updateDetail" type="button">Lưu phân loại</button>
      </div>
    </div>
  </div>
</div>
    {{-- Update --}}
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.28/dist/sweetalert2.all.min.js"></script>
    <script>
         function setvauleSelect2(e,data){
            if (e.find("option[value=" + data + "]").length) {
                e.val(data).trigger('change');
            }  
        }
        function insetOption(data,obj){
            let inner=`<option value="${data.id}">${data.name}</option>`
            obj.append(inner)
        }
        function setValueUpdate(id){
             $.ajax({
                url: '{{route("api.productdetail")}}',
                type: 'get',
                data:{
                    id:id
                },
                success: function(response) {
                    $('#quantityUpdate').val(response.quantity)
                    insetOption(response.color_product,$('#colorUpdate'))
                    setvauleSelect2($('#colorUpdate'),parseInt(response.id_color))
                    if(!isNaN(response.id_size))
                    $("#typeSizeUpdate option[value='1']").attr("selected", "selected");
                    else
                    $("#typeSizeUpdate option[value='2']").attr("selected", "selected");
                    insetOption(response.size_product,$('#sizeUpdate'))
                    setvauleSelect2($('#sizeUpdate'),parseInt(response.id_size))
                    inner='';
                    console.log(response)
                    $('.img').remove();
                    let i=0
                    response.img.forEach(function(item,index){
                        console.log(item)
                        i++;
                        inner+=`<div class="col-md-12 form-group row img">
                            <div class="col-md-6 form-group">
                            <label>Ảnh đại diện</label>
                            <input class = "form-control shadow-none rounded-0 file-img" name="photo${i}" type = "file">
                            @if($errors->has('photo'))
                                <div class="error">{{ $errors->first('photo') }}</div>
                            @endif
                            </div>
                            <div class="col-md-4 form-group">
                                <img style="width:100px; height:100%;" class="imgchange" src="{{asset('storage/${item.path}')}}" id="imgtype"/>
                            </div>
                            <div data-id=${item.id} class="col-md-2 d-flex align-items-center removeimg"
                                    class="btn btn-danger delete-category btn-xs m-r-5 remove"
                                    data-toggle="tooltip" data-original-title="Xóa"><i class="fa fa-trash font-14"></i>
                            </div>
                        </div>`
                    });
                    $('.removeimg').unbind('click');
                    $('#numberImg').val(i)
                    $('#idUpdate').val(response.id)
                    $('#sl').after(inner)
                    $('.removeimg').click(function(e){
                    let obj=$(this)
                    let id=$(this).attr('data-id')
                    console.log(id)
                      $.ajax({
                            url: "{{route('admin.product.removeimg')}}",
                            type: 'DELETE',
                            data:{
                                 "_token": "{{ csrf_token() }}",
                                id:id
                            },
                            success: function(response) {
                                Swal.fire({
                                icon: 'success',
                                title: 'Thêm thành công',
                                showConfirmButton: false,
                                timer: 1500
                                })
                                obj.closest('.img').remove()
                            },
                            error: function(response) {
                            
                            }
                        });
                })
                    
                },
                error: function(response) {
                }
            });
        }
        $('.remove').click(function(){
             setValueUpdate($(this).attr('data-id'))
        })
        $('.update').click(function(){
            console.log($(this).attr('data-id'))
            setValueUpdate($(this).attr('data-id'))
        })
         $(".color").select2({
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
                 $(".size").select2({
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
                 $("#sizeUpdate").select2({
                    ajax: {
                        url: '{{ route('api.size') }}',
                        data: function(params) {
                            const queryParameters = {
                                q: params.term,
                                type:$('#typeSizeUpdate').val()
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
     function sumitform(formData,obj,hander){
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
                success: hander,
                error: function(response) {
                    object=response.responseJSON?response.responseJSON.errors:{}
                     for (const property in object) {
                        obj.find('.error'+property).text(object[property][0])
                    }
                }
            });
    }     
    function successColor(response) {
                    Swal.fire({
                    icon: 'success',
                    title: 'Thêm thành công',
                    showConfirmButton: false,
                    timer: 1500
                    })
                //  obj.find('input').val(null)
                 obj.find('.text-danger').text('')
               
                }      
        $('#addcolor').click(function(){
        console.log('chay')
            const obj = $('#formcolor');
            const formData = new FormData(obj[0]);
           sumitform(formData,obj,successColor)
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
                  $('#quantity').val(null)
                  $('#photo').val(null)
                 obj.find('.text-danger').text('')
                 $('#size').val(null).trigger('change');
                 $('#color').val(null).trigger('change');
                   console.log(response)
                   inner=` <tr>
                        <td>${response[0].quantity}</td>
                        <td>${response[1]}</td>
                        <td>${response[2]}</td>
                    </tr>`

                    $('#body').append(inner);
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
     function successUpdatedetail(response) {
                    Swal.fire({
                    icon: 'success',
                    title: 'Thêm thành công',
                    showConfirmButton: false,
                    timer: 1500
                    })
                //  obj.find('input').val(null)
                 obj.find('.text-danger').text('')
               
                }      
        $('#addcolor').cli
    $('.updateDetail').click(function(){
        const obj = $('#formupdate');
        const formData = new FormData(obj[0]);
       sumitform(formData,obj,successUpdatedetail)
    })
   
    </script>
@endpush