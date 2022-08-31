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
     <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <form action="{{route('cart.checkout')}}" method="POST" class="row px-xl-5">
            @if($errors->has('msg'))
                        <div class="error">{{ $errors->first('msg') }}</div>
                    @endif
            @csrf
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Name</label>
                            <input class="form-control name" name="name" type="text" placeholder="John">
                              @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Phone</label>
                            <input class="form-control phone" name="phone" type="text" placeholder="Doe">
                              @if($errors->has('phone'))
                        <div class="error">{{ $errors->first('phone') }}</div>
                    @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control email" name="email" type="text" placeholder="example@email.com">
                              @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                    @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input class="form-control address" name="address" type="text" placeholder="+123 456 789">
                              @if($errors->has('address'))
                        <div class="error">{{ $errors->first('address') }}</div>
                    @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Note</label>
                            <textarea class="form-control note" name="note" type="text" placeholder="123 Street"></textarea>
                              @if($errors->has('note'))
                        <div class="error">{{ $errors->first('note') }}</div>
                    @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <input class="form-control country" name="country" type="text" placeholder="" value="Việt Nam">
                              @if($errors->has('country'))
                        <div class="error">{{ $errors->first('country') }}</div>
                    @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <select class="form-control city" name="city"></select>
                              @if($errors->has('city'))
                        <div class="error">{{ $errors->first('city') }}</div>
                    @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label>District</label>
                            <select class="form-control district" name="district"></select>
                              @if($errors->has('district'))
                        <div class="error">{{ $errors->first('district') }}</div>
                    @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control code" name="zip_code" type="text" placeholder="123">
                              @if($errors->has('code'))
                        <div class="error">{{ $errors->first('code') }}</div>
                    @endif
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="shipto">
                                <label class="custom-control-label" for="shipto"  data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                            </div>
                        </div> --}}
                    </div>
                </div>
                {{-- <div class="collapse mb-5" id="shipping-address">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Shipping Address</span></h5>
                    <div class="bg-light p-30">
                     <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Name</label>
                            <input class="form-control" name="name" type="text" placeholder="John">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Phone</label>
                            <input class="form-control" name="phone" type="text" placeholder="Doe">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" name="email" type="text" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input class="form-control" name="address" type="text" placeholder="+123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Note</label>
                            <textarea class="form-control" name="note" type="text" placeholder="123 Street"></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <input class="form-control" name="country" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" name="city" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>District</label>
                            <input class="form-control" name="district" type="text" placeholder="New York">
                        </div>
                    </div>
                    </div>
                </div> --}}
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        @forelse ($cart?$cart->getProductInCart():[] as $item)
                        <div class="d-flex justify-content-between">
                            <p>{{$item['productInfo']['namecolor'].'-'.$item['productInfo']['namesize']}}</p>
                            <p>{{$item['price']}}Đ</p>
                        </div>
                        @empty
                            
                        @endforelse
                        
                        {{-- <div class="d-flex justify-content-between">
                            <p>Product Name 2</p>
                            <p>$150</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Product Name 3</p>
                            <p>$150</p>
                        </div> --}}
                    </div>
                    <div class="mb-30 mt-3 border-bottom" action="">
                    <div class="input-group">
                            <input type="text" class="form-control border-0 p-4 inputdiscont" placeholder="Coupon Code">
                            <div class="input-group-append">
                                <button class="btn btn-primary applydiscount" type="button">Apply Coupon</button>
                            </div>
                        </div>
                    </div>
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                           <h6 ><span id="subtotal">{{$cart?$cart->getTotalMoney():0}}</span>Đ</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                          <h6 class="font-weight-medium "><span class="ship">10000</span>Đ</h6>
                        </div>
                          <div class="d-flex justify-content-between mt-3">
                            <h6 class="font-weight-medium">Discount</h6>
                            <input id="discount" name="discount" value=0>
                            <h6 class="font-weight-medium "><span class="discount">0</span>%</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                             <h5><span class="total">{{$cart?$cart->getTotalMoney():0}}</span>Đ</h5>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" value=1 id="paypal">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" value=2 id="directcheck">
                                <label class="custom-control-label" for="directcheck">Direct Check</label>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" value=3 id="banktransfer">
                                <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                            </div>
                        </div>
                        @if($errors->has('payment'))
                        <div class="error">{{ $errors->first('payment') }}</div>
                    @endif
                        <button class="btn btn-block btn-primary font-weight-bold py-3" type="submit">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Checkout End -->
@endsection
@push('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
         $('.applydiscount').click(function(){
                if($('.inputdiscont').val()){
                    $.ajax({
                        url: "{{route('cart.getdiscount')}}",
                        type: 'GET',
                        data:{
                            code :$('.inputdiscont').val() ,
                        },
                        success: function(response) {
                            console.log(response)
                            $('.discount').text(response)
                            $('#discount').val(response)
                            let total=(parseFloat($('#subtotal').text())*(100-response)/100)-parseFloat($('.ship').text())
                            console.log(total)
                            $('.total').text(total)
                        },
                        error: function(response) {
                        
                        }
                    });
                }
            })
         function changeTotal(){
                 let total=0
                if(parseFloat($('#subtotal').text())!=0){
                console.log(parseFloat($('#subtotal').text())*(100-parseFloat($('.discount').text()))/100)-parseFloat($('.ship').text())
                total=(parseFloat($('#subtotal').text())*(100-parseFloat($('.discount').text()))/100)-parseFloat($('.ship').text())
                //enableButton($('.checkout'),false)
                }
                console.log(total)
                $('.total').text(total)
            }
            changeTotal()
        async function loadDistrict(path) {
            $(".district").empty()
            const response = await fetch('{{ asset("location/data") }}'+'/' + path);
            const districts = await response.json();
             let string = '';
            // const selectedValue = $(".district").val();
            console.log( path)
            $.each(districts.district, function(index, each) {
                if (each.pre === 'Quận' || each.pre === 'Huyện') {
                    string += `<option`;
                    // if (selectedValue === each.name) {
                    //     string += ` selected `;
                    // }
                    string += `>${each.name}</option>`;
                }
            })
            $(".district").append(string);
            $('.district').val(null).trigger('change');
        }
       
            async function insertCity(){
            const response = await fetch('{{ asset('location/index.json') }}');
                const cities = await response.json();
                console.log(cities)
                $.each(cities, function(index, each) {
                    $(".city").append(`
                    <option data-path='${each.file_path}'>
                        ${index}
                    </option>`)
                })
                $('.city').val(null).trigger('change');
            }
           insertCity()
            $(".city").select2({
                tags: true
            });
            $(".district").select2({
                tags: true
            });
            $(document).on('change','.city',function(){
                if($(this).val()){
                    console.log($('.city').parent().find(".city option:selected").data('path'))
                    let path=$('.city').parent().find(".city option:selected").data('path')
                    let array=path.split("/");
                    loadDistrict(array[2])
                }
            })
            
    </script>
@endpush