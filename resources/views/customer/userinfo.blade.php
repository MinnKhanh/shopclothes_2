@extends('layout.master')
@push('css')
<style>
    body {
    background: whitesmoke;
    font-family: 'Open Sans', sans-serif;
}

.container {
    max-width: 960px;
    margin: 30px auto;
    padding: 20px;
}

h1 {
    font-size: 20px;
    text-align: center;
    margin: 20px 0 20px;
    
}
h1 small {
        display: block;
        font-size: 15px;
        padding-top: 8px;
        color: gray;
    }
.avatar-upload {
    position: relative;
    max-width: 205px;
    margin: 50px auto;

    
}
.avatar-upload .avatar-edit {
        position: absolute;
        right: 12px;
        z-index: 1;
        top: 10px;
       
    }
.avatar-upload .avatar-edit input {
            display: none;
            
        }
.avatar-upload .avatar-edit input + label {
                display: inline-block;
                width: 34px;
                height: 34px;
                margin-bottom: 0;
                border-radius: 100%;
                background: #FFFFFF;
                border: 1px solid transparent;
                box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
                cursor: pointer;
                font-weight: normal;
                transition: all .2s ease-in-out;
                
            }
.avatar-upload .avatar-edit input + label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }
.avatar-upload .avatar-edit input + label .pencil {
    font-family: 'FontAwesome';
    color: #757575;
    position: absolute;
    top: 10px;
    left: 0;
    right: 0;
    text-align: center;
    margin: auto;
}
.avatar-upload .avatar-preview {
        width: 192px;
        height: 192px;
        position: relative;
        border-radius: 100%;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        
    }
.avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
</style>
@endpush
@section('content')
@php
    use App\Enums\RoleEnum;
@endphp
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{route('user.updateinfo')}}" method="POST" class="d-flex row">
                @csrf
                <div class="col-12">
                        <div class="avatar-upload col-6">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill pencil" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
                                </div>
                            </div>
                        </div>
                </div>
                
                    <div class="col-6">
                        <label for="">Tên</label>
                        <input class="form-control rounded-0 shadow-none text-box single-line" value="{{auth()->user()->name}}"  id="name" name="name" placeholder="Tên người dùng" type="text" value="" /> 
                        <div class="field-validation-valid text-danger mb-3"> 
                            @if($errors->has('name'))
                                {{ $errors->first('name') }}
                            @endif
                        </div> 
                    </div>
                     <div class="col-6">
                        <label for="">Giới tính</label>
                        <select class="form-control rounded-0 shadow-none text-box single-line"  id="gender" name="gender">
                            <option value="0" {{auth()->user()->gender==null?'selected':''}}>--Chọn--</option> 
                            <option value="1" {{auth()->user()->gender==1?'selected':''}}>Nam</option>    
                            <option value="2" {{auth()->user()->gender==2?'selected':''}}>Nữ</option>    
                            <option value="3" {{auth()->user()->gender==3?'selected':''}}>Khác</option>    
                        </select> 
                        <div class="field-validation-valid text-danger mb-3"> 
                            @if($errors->has('gender'))
                                {{ $errors->first('gender') }}
                            @endif
                        </div> 
                    </div>
                    <div class="col-6">
                        <label for="">Tuổi</label>
                        <input class="form-control rounded-0 shadow-none text-box single-line" value="{{auth()->user()->age}}"  id="age" name="age" /> 
                        <div class="field-validation-valid text-danger mb-3"> 
                            @if($errors->has('age'))
                                {{ $errors->first('age') }}
                            @endif
                        </div> 
                    </div>
                     <div class="col-6">
                        <label for="">Email</label>
                        <input class="form-control rounded-0 shadow-none text-box single-line" value="{{auth()->user()->email}}"  id="email" name="email" placeholder="Email người dùng" type="text" value="" /> 
                        <div class="field-validation-valid text-danger mb-3"> 
                            @if($errors->has('email'))
                                {{ $errors->first('email') }}
                            @endif
                        </div> 
                    </div>
                    <div class="col-6">
                        <label for="">Số điện thoại</label>
                        <input class="form-control rounded-0 shadow-none text-box single-line" value="{{auth()->user()->phone}}"  id="phone" name="phone" placeholder="Số điện thoại người dùng" type="text" value="" /> 
                        <div class="field-validation-valid text-danger mb-3"> 
                            @if($errors->has('phone'))
                                {{ $errors->first('phone') }}
                            @endif
                        </div> 
                    </div>
                    <div class="col-6">
                        <label for="">Địa chỉ</label>
                        <input class="form-control rounded-0 shadow-none text-box single-line" value="{{auth()->user()->address}}"  id="address" name="address" placeholder="Đia chỉ" type="text" value="" /> 
                        <div class="field-validation-valid text-danger mb-3"> 
                            @if($errors->has('address'))
                                {{ $errors->first('address') }}
                            @endif
                        </div> 
                    </div>
                    <div class="col-6">
                        <label for="">Thành phố</label>
                        <input class="form-control rounded-0 shadow-none text-box single-line"  id="city" name="city" type="text" value="" /> 
                        <div class="field-validation-valid text-danger mb-3"> 
                            @if($errors->has('city'))
                                {{ $errors->first('city') }}
                            @endif
                        </div> 
                    </div>
                    <div class="col-6">
                        <label for="">Quận/Huyện</label>
                        <input class="form-control rounded-0 shadow-none text-box single-line"  id="district" name="district" type="text" value="" /> 
                        <div class="field-validation-valid text-danger mb-3"> 
                            @if($errors->has('district'))
                                {{ $errors->first('district') }}
                            @endif
                        </div> 
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-primary btn-sm mb-2 d-block buttonchange">Lưu</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});
    </script>
@endpush