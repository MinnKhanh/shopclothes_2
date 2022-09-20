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

<form action="{{route('admin.product.store')}}" class = "row px-xl-3" method="POST" enctype = "multipart/form-data">
    @csrf
 <div class="col-12">
        <h5 class="title position-relative text-dark text-uppercase mb-3">
            <span class="bg-secondary pe-3">Thông tin chung</span>
        </h5>
        <div class="bg-light p-30">
              @if($errors->has('msg'))
                        <div class="error">{{ $errors->first('msg') }}</div>
                    @endif
            <div class="row">
                @if (isset($edit))
                     <input type="text" class="d-none" value={{$product['id']}} name="id">
                @endif
                <div class="col-md-4 form-group">
                    <label>Phân loại chính</label>
                    <select name="type" id="type" class ="form-control" data-old='{{isset($edit)?$product['type']:old('type')}}'>
                        @if(old('type') != NULL || isset($edit))
                        <option value="{{isset($edit)?$product['type']:old('type')}}">{{$type->where('id', isset($edit)?$product['type']:intval(old('type')))->first()->name}}</option>
                    @endif
                    </select>
                    @if($errors->has('type'))
                        <div class="error">{{ $errors->first('type') }}</div>
                    @endif
                </div>
                <div class="col-md-4 form-group">
                    <label>Phân loại phụ</label>
                    <select name="category" class = "form-control" id="category" data-old="{{isset($edit)?$product['category']:old('category')}}">
                         @if(old('category') != NULL || isset($edit))
                        <option value="{{isset($edit)?$product['category']:old('category')}}">{{$type->with(['Categories' => fn ($query) => $query->where('id', isset($edit)?$product['category']:intval(old('category')))])->where('id', isset($edit)?$product['type']:intval(old('type')))
                        ->get()->first()->toArray()['categories'][0]['name']}}
                        </option>
                    @endif
                    </select>
                    @if($errors->has('category'))
                        <div class="error">{{ $errors->first('category') }}</div>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label>Mã sản phẩm</label>
                    <input class = "form-control shadow-none rounded-0" name="code" value="{{isset($edit)?$product['code']:old('code')}}" placeholder = "AOKHOAC001">
                     @if($errors->has('code'))
                        <div class="error">{{ $errors->first('code') }}</div>
                    @endif
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary rounded-0 shadow-none mt-3">Lưu sản phẩm</button>
                </div>
        </div>
        </div>
    </div>
</form>    
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.28/dist/sweetalert2.all.min.js"></script>
    <script>
    </script>
@endpush