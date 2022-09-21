@extends('layout.master')
@push('css')
     <style>
        .img-fluid{
            height: 260px;
            
        }
        .priceitem{
                font-size: .9rem
        }
        .paginationjs-page > a,.paginationjs-prev >a,.paginationjs-next > a {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #FFD333 !important;
            background-color: #fff;
            border: 1px solid #dee2e6;

        }
        .active >a{
            background-color:  #ffc107;
            color: white !important;
        }
        .paginationjs-page > a:hover,.paginationjs-prev >a:hover,.paginationjs-next > a:hover {
            z-index: 2;
            color: #FFD333 !important;
            text-decoration: none;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
        li{
            list-style: none;
        }
        .paginationjs-pages > ul{
            display: flex;
            justify-content: center;
        }
        .autoComplete_list_1{
            position: relative;
        }
         #autoComplete_list_1{
            position: absolute;
            /* transform: translate(0, 20px); */
            z-index: 1;
            top: 38px;
            left: 0px;
            background-color: white;
            padding-left: 10px;
            width: 100%;
        }
        #autoComplete_list_1 > li{
            margin-top: 8px;
             margin-bottom: 8px;
        }
        #autoComplete_list_1 > li:hover{
            background-color: #f8f8f8
        }
        .imgtype{
                width: 100%;
    height: 100%;
        }
        .title{
            border: 1px solid gray;
        }
        .introduce-content{
            border: 1px solid gray;
        }
    .emptyproduct{
        position: absolute;
        z-index: 1;
        background: #6c6c6c;
        color: #fafafa;
        top: 8px;
        right: 6px;
        padding: 1px 10px;
        font-size: .8rem;
        border-radius: 1px;
    }
    </style>
@endpush

@section('content')
<!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <h3 class="border-bottom mt-3 mb-5 col-3 pb-4">Chỉnh sửa quảng cáo</h3>
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                        <li data-target="#header-carousel" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/carousel-1.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown title">Tiêu Đề</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn introduce-content">Nội dung giới thiệu sản phẩm trong cửa hàng hiện tại</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 btn-primary animate__animated animate__fadeInUp buttomfix" href="{{route('admin.customize.edit')}}">Customize now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/carousel-2.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                      <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown title">Tiêu Đề</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn introduce-content">Nội dung giới thiệu sản phẩm trong cửa hàng hiện tại</p>
                                   <a class="btn btn-outline-light py-2 px-4 mt-3 btn-primary animate__animated animate__fadeInUp buttomfix" href="{{route('admin.customize.edit')}}">Customize now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/carousel-3.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                      <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown title">Tiêu Đề</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn introduce-content">Nội dung giới thiệu sản phẩm trong cửa hàng hiện tại</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 btn-primary animate__animated animate__fadeInUp buttomfix" href="{{route('admin.customize.edit')}}">Customize now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/carousel-3.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                      <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown title">Tiêu Đề</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn introduce-content">Nội dung giới thiệu sản phẩm trong cửa hàng hiện tại</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 btn-primary animate__animated animate__fadeInUp buttomfix" href="{{route('admin.customize.edit')}}">Customize now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="img/offer-1.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Tiêu đề</h6>
                        <h3 class="text-white mb-3">Nội dung</h3>
                        <a class="btn btn-outline-light btn-primary py-2 px-4 mt-3 animate__animated animate__fadeInUp buttomfix" href="{{route('admin.customize.edit')}}">Customize now</a>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="img/offer-2.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Tiêu đề</h6>
                        <h3 class="text-white mb-3">Nội dung</h3>
                        <a class="btn btn-outline-light py-2 btn-primary px-4 mt-3 animate__animated animate__fadeInUp buttomfix" href="{{route('admin.customize.edit')}}">Customize now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>

    </script>    
@endpush
