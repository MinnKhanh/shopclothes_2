@extends('layout.master')
@section('content')
@php
    use App\Enums\RoleEnum;
@endphp
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-4">
            <h2 class="text-center my-4">Cập nhật tài khoản</h2>
            <span class="field-validation-valid text-danger mb-3"> 
                @if($errors->has('msg'))
                    {{ $errors->first('msg') }}
                @endif
            </span> 
    <form action="{{route('auth.update')}}" method="POST" class = "d-flex flex-column">
                @csrf
            @method('PUT')
            <label for="">Tên tài khoản</label>
            <input class="form-control rounded-0 shadow-none text-box single-line" disabled value="{{auth()->user()->username}}"  id="username" name="username" placeholder="Tên đăng nhập" type="text" value="" />
            <span class="field-validation-valid text-danger mb-3"> 
                @if($errors->has('username'))
                    {{ $errors->first('username') }}
                @endif
            </span> 
            <label for="">Mật khẩu cũ</label>
            <input class="form-control rounded-0 shadow-none" id="password" name="password" placeholder="Mật khẩu" type="password" value="" />
            <span class="field-validation-valid text-danger mb-3"> 
                    @if($errors->has('password'))
                        {{ $errors->first('password') }}
                    @endif
                </span> 
            <label for="">Mật khẩu mới</label>
            <input class="form-control rounded-0 shadow-none" id="password" name="newpassword" placeholder="Mật khẩu" type="password" value="" />
            <span class="field-validation-valid text-danger mb-3"> 
                    @if($errors->has('password'))
                        {{ $errors->first('password') }}
                    @endif
                </span> 
            <label for="">Xác nhận mật khẩu mới</label> 
            <input class="form-control rounded-0 shadow-none" id="passwordconfirm" name="newpassword_confirmation" placeholder="Mật khẩu" type="passwordconfirm" value="" />
            <span class="field-validation-valid text-danger mb-3"> 
                    @if($errors->has('password_confirmation'))
                        {{ $errors->first('password_confirmation') }}
                    @endif
                </span>          
            <button class="btn btn-primary rounded-0 shadow-none mb-3">Câp nhật</button>
    </form>
            <p class="text-center">Bạn đã có tài khoản? <a href="{{route('auth.login')}}" class="text-primary">Đăng nhập</a></p>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        
    </script>
@endpush