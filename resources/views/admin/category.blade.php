@extends('layout.master')
@section('content')
    
<form action="" class = "row px-xl-3" enctype = "multipart/form-data">
<div class="col-12">
        <h5 class="title position-relative text-dark text-uppercase mb-3 mt-3">
            <span class="bg-secondary pe-3">Thông tin phân loại</span>
        </h5>
        <div class="custom-datatable bg-light p-30 table-responsive">
            <div class="row mb-3">
                <input type="text" name="MaSanPham" id="MaSanPham" value="MaSanPham" hidden />
                <div class="col-md-6 form-group">
                    <label>Màu sắc</label>
                    <select name="" class = "form-select shadow-none rounded-0" id=""></select>
                    <span class="text-danger">ErrorMessageCategory</span>
                </div>
                <div class="col-md-6 form-group">
                    <label>Kích cỡ</label>
                    <select class="form-select shadow-none rounded-0" name="KichCo" id="KichCo">
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="2XL">2XL</option>
                        <option disabled>---</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                    </select>
                    <span class="text-danger">ErrorMessageCategory</span>
                </div>
                <div class="col-md-6 form-group">
                    <label>Số lượng</label>
                    <input type="text" class = "form-control shadow-none rounded-0" placeholder = "Số lượng">
                    <span class = "text-danger"></span>
                </div>
                <div class="col-md-6 form-group">
                    <label>Ảnh phân loại</label>
                    <input type="file" multiple = true  class = "form-control shadow-none rounded-0">
                   
                    <span class="text-danger">ErrorMessageFile</span>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary rounded-0 shadow-none mt-3">Lưu phân loại</button>
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
                    {{-- @foreach (var categoryColorSizeItem in ViewBag.CategorySizeColorList)
                    { --}}
                        <tr>
                            <td>TenMau</td>
                            <td>KichCo</td>
                            <td>SoLuong</td>
                        </tr>
                    {{-- } --}}
                </tbody>
            </table>
        </div>
    </div>
</form>
@endsection