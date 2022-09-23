@extends('layout.master')
@push('css')
    <style>
        .imgchange {
            width: 100%;
            height: 100%;
        }
    </style>
@endpush
@section('content')
    @php
        use BenSampo\Enum\Enum\DiscountTypeEnum;
    @endphp
    <div class="row px-xl-3">
        <div class="col-12">
            <h5 class="title position-relative text-dark text-uppercase mb-3">
                <span class="bg-secondary pe-3">Tạo phiếu giảm giá</span>
            </h5>
            <div class="custom-datatable bg-light p-30 table-responsive">
                <form id="formcategory" class="" action="{{ route('admin.discount.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @if (isset($isedit))
                        <input type="text" class="d-none" name="id" value={{ $id }}>
                    @endif
                    <div class="row col-12">
                        <div class="col-md-6 form-group mb-4">
                            <label>Tên</label>
                            <input class="form-control shadow-none rounded-0" id="name" type="text" name="name"
                                value={{ isset($discount) ? $discount['name'] : '' }}>
                            <span class="text-danger errorname"></span>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label>Loại</label>
                            <select class="form-control shadow-none rounded-0" id="country" name="country">
                                @forelse (DiscountTypeEnum::getKey() as $item)
                                    <option value="">{{ $item }}</option>
                                @empty
                                @endforelse
                            </select>
                            <span class="text-danger errorname"></span>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-md-6 form-group mb-4">
                            <label>Thời điểm bắt đầu</label>
                            <input class="form-control shadow-none rounded-0" type="date" id="begin" type="text"
                                name="begin" value={{ isset($discount) ? $discount['begin'] : '' }}>
                            <span class="text-danger errorname"></span>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label>Thời điểm kết thúc</label>
                            <input class="form-control shadow-none rounded-0" type="date" id="end" name="end"
                                value={{ isset($discount) ? $discount['end'] : '' }}>
                            <span class="text-danger errorname"></span>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-md-6 form-group mb-4">
                            <label>Mã</label>
                            <input class="form-control shadow-none rounded-0" id="namecategory" type="text"
                                name="name" value={{ isset($discount) ? $discount['code'] : '' }}>
                            <span class="text-danger errorname"></span>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label>Loại</label>
                            <input class="form-control shadow-none rounded-0" type="number" id="persent" name="persent"
                                value={{ isset($discount) ? $discount['persent'] : '' }}>
                            <span class="text-danger errorname"></span>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-md-6 form-group">
                            <div class="col-md-6 form-group">
                                <label>Ảnh</label>
                                <input class="form-control file-img" name="photo" id="photocategory" type="file">
                                <span class="text-danger errorphoto"></span>
                            </div>
                            <div class="col-md-6">

                                <img style="width:200px; height:100%;"
                                    src="{{ isset($discount) ? asset('storage/' . (isset($discount['img'][0]) ? $discount['img'][0]['path'] : '')) : '' }}"
                                    class="imgchange" id="imgcategory" />
                            </div>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label>Mô tả</label>
                            <textarea class="form-control shadow-none rounded-0" rows="8" id="namecategory" type="text" name="description">
                                @if (isset($discount))
{{ isset($discount['img'][0]) ? $discount['description'] : '' }}
@endif
                            </textarea>
                            <span class="text-danger errorname"></span>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary closecategory" data-dismiss="modal">Đóng</button>
                        @if (isset($isedit))
                            <button type="submit" class="btn btn-primary save">Cập nhật</button>
                        @else
                            <button type="submit" class="btn btn-primary save">Thêm</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script></script>
@endpush
