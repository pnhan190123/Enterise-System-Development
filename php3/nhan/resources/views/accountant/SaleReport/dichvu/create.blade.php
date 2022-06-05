@extends('accountant.layout')

@section('pagetitle', 'THÊM THỂ LOẠI')

@section('main')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach (@errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{ route('serviceAccountant.store') }}">
    {{ csrf_field() }}
    <div class="col-9 mg-l-30" style="margin: 0 auto;">
        <div class="d-flex flex-column">
            <div class="form-group mb-b-20">
                <label for="">
                    Tên dịch vụ: <span class="tx-danger">*</span>
                </label>
                <input type="text" name="ten_dv" placeholder="Nhập tên dịch vụ" class="form-control" required>
            </div>
            <div class="form-group mg-b-20">
                <label for="">Tiền dịch vụ:</label>
                <input type="number" name="tien_dv" placeholder="Nhập tiền dịch vụ" class="form-control" required>
            </div>
            <div class="form-group mg-b-20">
                <label for="">Nội dung:</label>
                <input type="text" name="noidung" placeholder="Nhập nội dung" class="form-control">
            </div>
        </div>
        <div class="form-group mg-b-20">
                <label for="">Thời gian (Tính bằng ngày):</label>
                <input type="number" name="thoigian" placeholder="Nhập thời gian" class="form-control" required>
        </div>
        <div class="d-flex justify-content-around">
            <div class="d-flex form-group mg-b-20">
                <label class="rdiobox mx-4">
                    <input type="radio" name="AnHien" value="1" checked>
                    <span>Hiện</span>
                </label> &nbsp;
                <label class="rdiobox">
                    <input type="radio" name="AnHien" value="0">
                    <span>Ẩn</span>
                </label>
            </div>
         

          
        </div>
        <button type="submit" class="btn btn-primary">Lưu database</button>
    </div>
</form>

@endsection
