@extends('layout.master')
@push('css')
    <style>
        .img {
            width: 172px;
            height: 100px;
        }

        .itemimg {
            width: 20%;
            height: 50%;
        }

        .itemcount {
            width: 11%;
        }

        .custom {
            width: 20%;
        }

        .buttonchange {
            width: 100%;
        }

        .buttoncate {
            width: 30%;
        }
    </style>
@endpush
@section('content')
    @php
        use App\Enums\TypeShipEnum;
    @endphp
    <div class="row px-xl-3">
        <div class="col-12">
            <h5 class="title position-relative text-dark text-uppercase mb-3">
                <span class="bg-secondary pe-3">Phí Vận Chuyển</span>
            </h5>
            <div class="custom-datatable bg-light p-30 table-responsive d-flex justify-content-center">
                <div class="col-5">
                    <label for="shiptitle">Vùng vận chuyển</label>
                    <select name="shiptitle" class="form-control" id="shiptitle">
                        @forelse ($list as $item)
                            <option value={{ $item['id'] }}>{{ TypeShipEnum::getType($item['location']) }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="col-4 ml-2">
                    <label for="price">Giá</label>
                    <input type="text" id="price" class="form-control" value={{ $list[0]['price'] }}>
                </div>
                <button class="btn btn-primary mt-4 ml-2 col-1">Cập nhật</button>
            </div>
        </div>
    @endsection

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.28/dist/sweetalert2.all.min.js"></script>
        <script>
            $('#shiptitle').change(function() {
                let list = "{{ $list }}"
                console.log(list)
                //let price =
            })
        </script>
    @endpush
