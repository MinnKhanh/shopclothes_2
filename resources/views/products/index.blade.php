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
    </style>
         {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.min.css"> --}}

  @endpush
  @section('content')
  <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 price">
                            <input type="checkbox" class="custom-control-input inputPrice" checked id="price-all">
                            <label class="custom-control-label priceall" for="price-all">All Price</label>
                            <span class="badge border font-weight-normal">100.000Đ</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 price">
                            <input type="checkbox" class="custom-control-input inputPrice inputPriceitem" id="price-1">
                            <label class="custom-control-label lbprice priceitem" for="price-1">< 100.000Đ</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 price">
                            <input type="checkbox" class="custom-control-input inputPrice inputPriceitem" id="price-2">
                            <label class="custom-control-label lbprice priceitem" for="price-2">100.000Đ - 200.000Đ</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 price">
                            <input type="checkbox" class="custom-control-input inputPrice inputPriceitem" value='200000-400000' id="price-3">
                            <label class="custom-control-label lbprice priceitem" for="price-3">200.000 - 400.000Đ</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 price">
                            <input type="checkbox" class="custom-control-input inputPrice inputPriceitem" id="price-4">
                            <label class="custom-control-label lbprice priceitem" for="price-4">400.000Đ - 600.000Đ</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 price">
                            <input type="checkbox" class="custom-control-input inputPrice inputPriceitem" id="price-5">
                            <label class="custom-control-label lbprice priceitem" for="price-5">600.000Đ - 1000.000Đ</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between price">
                            <input type="checkbox" class="custom-control-input inputPrice inputPriceitem" id="price-6">
                            <label class="custom-control-label lbprice priceitem" for="price-6">> 1000.000Đ</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Price End -->
                
                <!-- Color Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by type</span></h5>
                <div class="bg-light p-4 mb-30">
                      <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input typeall" value=0 checked id="type-all">
                            <label class="custom-control-label" for="type-all">All Type</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        @forelse ($type as $item)
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input type" value={{$item['id']}} id="type-{{$item['id']}}">
                            <label class="custom-control-label" for="type-{{$item['id']}}">{{$item['name']}}</label>
                            <span class="badge border font-weight-normal">150</span>
                            </div>
                        @empty
                            
                        @endforelse
                    </form>
                  
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                         <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input categoryall" checked id="category-all">
                            <label class="custom-control-label" for="category-all">All Category</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        @forelse ($categories as $item)
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input category" value={{$item['id']}} id="category-{{$item['id']}}">
                            <label class="custom-control-label" for="category-{{$item['id']}}">{{$item['name']}} ({{$item['typename']}})</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        @empty
                            
                        @endforelse
                        {{-- <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2">
                            <label class="custom-control-label" for="color-2">White</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3">
                            <label class="custom-control-label" for="color-3">Red</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4">
                            <label class="custom-control-label" for="color-4">Blue</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5">
                            <label class="custom-control-label" for="color-5">Green</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div> --}}
                    </form>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex">
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                                <div>
                                <form action="" class="ml-2">
                                    <div class="input-group">
                                        <input type="search" class="form-control" id="autoComplete" placeholder="Search for products">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-transparent text-primary">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                               {{-- <input id="autoComplete" type="search" dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off"> --}}
                            </div>
                            </div>
                            
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item sort" data-sort='created_at'>Latest</div>
                                        <div class="dropdown-item sort" data-sort='rate' >Best Rating</div>
                                    </div>
                                </div>
                                {{-- <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                     <div class="col-12 pb-1 row" id="list-products">
                    {{-- @forelse ($list as $item) --}}
                         {{-- <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100 imgProduct" src="{{asset('storage/'.$item['img'][0]['path'])}}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{$item['name']}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{$item['priceSell']}}Đ</h5>
                                </div>
                                 <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{$item['brand_product']['name']}}</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    {{-- <small>(99)</small> --}}
                                {{-- </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- @empty
                        
                    @endforelse --}}
                   
                    {{-- <div class="col-lg-4 col-md-6 col-sm-6 pb-1"> --}}
                        {{-- <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="img/product-2.jpg" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star-half-alt text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="img/product-3.jpg" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star-half-alt text-primary mr-1"></small>
                                    <small class="far fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="img/product-4.jpg" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="far fa-star text-primary mr-1"></small>
                                    <small class="far fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="img/product-5.jpg" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="img/product-6.jpg" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star-half-alt text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="img/product-7.jpg" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star-half-alt text-primary mr-1"></small>
                                    <small class="far fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="img/product-8.jpg" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="far fa-star text-primary mr-1"></small>
                                    <small class="far fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="img/product-9.jpg" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="far fa-star text-primary mr-1"></small>
                                    <small class="far fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                     </div>
                     <div class="col-12 pb-1" id="pagination">
                    {{-- <div class="col-12"> 
                        <nav>
                          <ul class="pagination justify-content-center">
                              
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</span></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                          </ul>
                        </nav>
                    </div> --}}
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    @endsection
    @push('js')
        <script src={{ asset("js/pagination.js")}}></script>
         <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>
    <script>
        $.ajax({
                url: "{{route('api.listnameproduct')}}",
                method: 'GET',
                success: function (response) {
                    console.log(response)
                       const autoCompleteJS = new autoComplete({
                        placeHolder: "Search for Food...",
                        data: {
                            src: response,
                            cache: true,
                        },
                        resultItem: {
                            highlight: true
                        },
                        events: {
                            input: {
                                selection: (event) => {
                                    const selection = event.detail.selection.value;
                                    autoCompleteJS.input.value = selection;
                                }
                            }
                        }
                    });
                }
                })


        var rangePrice=''
        var Maphanloai=''
        var categories=''
        var search=''
        var sort=''
        $('.sort').click(function(){
            sort=$(this).attr('data-sort')
            getProduct()
        })
         getProduct()
         $("#price-all").change(function(){
             console.log('cha nha')
            rangePrice=""
            if($('#price-all').is(':checked')){
                $(".inputPriceitem").prop( "checked", false );
            }
            getProduct()
        })
        $('.inputPriceitem').change(function(){
            console.log($(".inputPriceitem:checked"))
             if( $(".inputPriceitem:checked").length>0){
             document.getElementById("price-all").checked = false;
            }else{
             document.getElementById("price-all").checked = true;
            }
            let i=0
           rangePrice=''
             $(".inputPriceitem:checked").each(function(){
                if(i==0)
                 rangePrice+=$(this).next().text()
                else
                rangePrice+="_"+$(this).next().text()
               i++;
        })
        //console.log(rangePrice)
        getProduct()
        })

          function showproduct(response){
    $('#pagination').pagination({
    dataSource: response,
    pageSize: 3,
    formatResult: function(data) {
       
    },
    callback: function(response, pagination) {
        console.log("respon",response)
        let inner=''
        response.forEach(element => {
                inner+=`  <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100 imgProduct" src="{{asset('storage/')}}/${element['img'][0]['path']}" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="{{route('product.productdetail')}}?id=${element['id']}">${element['name']}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>${element['priceSell']}Đ</h5>
                    </div>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>${element['brand_product']['name']}</h5>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        {{-- <small>(99)</small> --}}
                    </div>
                </div>
            </div>
        </div>`
        });
         document.getElementById('list-products').innerHTML = inner;
          
    }
})
     
  }
        function getProduct(){
              $.ajax({
                url: "{{route('product.listproduct')}}"+'?type='+Maphanloai+'&category='+categories+'&price='+rangePrice+'&search='+search+'&sort='+sort,
                method: 'GET',
                success: function (response) {
                    console.log(response);
                   showproduct(response)
                   
                }
                })
        }
        $('#autoComplete').change(function(){
            search=$(this).val()
            getProduct()
        })
        $('.type').change(function(){
            if( $(".type:checked").length>0){
             document.getElementById("type-all").checked = false;
            }else{
             document.getElementById("type-all").checked = true;
            }
            let i=0
             Maphanloai=''
           $(".type:checked").each(function(){
                if(i==0)
                Maphanloai+=$(this).val()
                else
                Maphanloai+="-"+$(this).val()
               i++;
        });
        getProduct()
        console.log(Maphanloai)
        })
         $('.category').change(function(){
            if( $(".category:checked").length>0){
             document.getElementById("category-all").checked = false;
            }else{
             document.getElementById("category-all").checked = true;
            }
            let i=0
             categories=''
           $(".category:checked").each(function(){
                if(i==0)
                categories+=$(this).val()
                else
                categories+="-"+$(this).val()
               i++;
            });
             getProduct()
            console.log(categories)
        })
         $(".categoryall").change(function(){
            categories=""
            if($('.categoryall').is(':checked')){
                $(".category").prop( "checked", false );
            }
             getProduct()
        })
         $(".typeall").change(function(){
            categories=""
            if($('.typeall').is(':checked')){
                $(".type").prop( "checked", false );
            }
             getProduct()
        })
    </script>
        
    @endpush