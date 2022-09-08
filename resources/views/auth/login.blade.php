@extends('layout.master')
@section('content')
    <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-4">
            <h2 class="text-center my-4" >Đăng nhập</h2>
            <form action="{{route('auth.signin')}}" method="POST" class = "d-flex flex-column">
                @csrf
                <input type="text" name="email" class = "form-control rounded-0 shadow-none mb-3">
                <input type="password" name="password" class = "form-control rounded-0 shadow-none mb-3">
                <button type="submit" class="btn btn-primary rounded-0 shadow-none mb-3">Đăng nhập</button>
            </form>
            <p class="text-center">Bạn chưa có tài khoản? <a href="{{route('auth.register')}}" class="text-primary">Đăng ký</a></p>

        </div>
    </div>
</div>
@endsection
@push('js')
    <script>

    </script>
@endpush