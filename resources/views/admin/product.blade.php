@extends('layout.master')
@section('content')
    <div class="row px-xl-3">
    <div class="col-12">
        <h5 class="title position-relative text-dark text-uppercase mb-3">
            <span class="bg-secondary pe-3">Danh sách sản phẩm</span>
        </h5>
        <div class="custom-datatable bg-light p-30 table-responsive">
            <form action="{{route('admin.product.addproduct')}}" class = "mb-3"> <button type="submit" class="btn btn-primary rounded-0 shadow-none">Thêm sản phẩm</button></form>
          
            <table id="product-table" class="table table-bordered text-center">
                <thead class="align-middle table-dark">
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá nhập</th>
                        <th>Giá bán</th>
                        <th>Phân loại</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    {{-- @foreach (var productItem in ViewBag.ProductList)
                    { --}}
                        <tr>
                            <td>MaSanPham</td>
                            <td>
                                <img src="~/Content/assets/img/test-sp-img/AnhDaiDien" class="product-info-img">
                                TenSanPham
                            </td>
                            <td>GiaNhap</td>
                            <td>GiaBan</td>
                            <td>PhanLoaiPhu</td>
                            <td class="align-middle d-flex flex-column">
                                <a href="/Admin/AddCategoryProduct?masanpham=MaSanPham" type="button" class="btn btn-primary btn-sm shadow-none rounded-0 mb-2">
                                    <i class="fas fa-plus me-2"></i>Thêm phân loại
                                </a>
                                <form action="">
                                     <button type="submit" class="btn btn-danger btn-sm shadow-none rounded-0 mb-2 w-100">
                                        <i class="fas fa-trash me-2"></i>Xoá
                                    </button>
                                </form>
                              
                                {{-- @if (TrangThai)
                                { --}}
                                    <form action="">
                                        <button type="submit" class="btn btn-success btn-sm shadow-none rounded-0 w-100 mb-2">
                                            <i class="fas fa-check me-2"></i>Hiển thị
                                        </button>
                                    </form>
                                   
                                {{-- } --}}
                                {{-- else
                                {
                                    <form action="">
                                        <button type="submit" class="btn btn-danger btn-sm shadow-none rounded-0 w-100 mb-2">
                                            <i class="fas fa-ban me-2"></i>Ẩn
                                        </button>
                                    </form>
                                   
                                }
                                @if (NoiBat)
                                {

                                   
                                        <form action="">
                                        <button type="submit" class="btn btn-success btn-sm shadow-none rounded-0 w-100">
                                            <i class="fas fa-check me-2"></i>Có nổi bật
                                        </button>
                                    </form>
                                       
                                    

                                }
                                else
                                {
                                    <form action="">
                                        <button type="submit" class="btn btn-danger btn-sm shadow-none rounded-0 w-100">
                                            <i class="fas fa-ban me-2"></i>Không nổi bật
                                        </button>
                                    </form>
                                    
                                } --}}
                            </td>
                        </tr>
                    {{-- }re --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection