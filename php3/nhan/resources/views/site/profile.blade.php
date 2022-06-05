@extends('site.layout')

@section('title')
    Thông Tin Cá Nhân
@endsection

@section('main')
<style>
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid transparent;
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        padding: 2em;
    }
</style>
<div class="container" style="margin-top: 100px;margin-bottom: 100px;">
    <div class="main-body">
        @if (session('mess'))
            {{ session('mess') }}
        @endif
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://image.flaticon.com/icons/png/512/149/149071.png" style="border-radius: 100px;width: 155px !important;" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                            <div class="mt-5" style="margin-top: .5em;">
                                <h4>{{ $user->hoten }}</h4>
                            </div>
                        </div>
                        <hr class="my-4">

                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('/site/profile/user') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $user->idUser }}" name="idUser" class="form-control">

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" readonly name="email" value="{{ $user->email }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Họ Tên</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" @if ($checkAuth == false) readonly @endif name="hoten" value="{{ $user->hoten }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Số điện thoại</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" @if ($checkAuth == false) readonly @endif name="sdt" value="{{ $user->sdt }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Địa chỉ</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" @if ($checkAuth == false) readonly @endif name="diachi" value="{{ $user->diachi }}">
                                </div>
                            </div>
                            @if ($checkAuth == true)
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Lưu">
                                    </div>
                                </div>
                            @endif

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
