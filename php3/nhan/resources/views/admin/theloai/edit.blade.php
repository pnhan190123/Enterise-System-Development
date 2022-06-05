@extends('admin.layout')

@section('pagetitle', 'SỬA THỂ LOẠI')

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

<form method="post" action="{{ route('theloai.update', $row->idTL) }}">
    {{ csrf_field() }}
    {!! method_field('patch') !!}
    <div class="col-9 mg-l-30" style="margin: 0 auto;">
        <div class="d-flex flex-column">
            <div class="form-group mb-b-20">
                <label for="">
                    Tên thể loại: <span class="tx-danger">*</span>
                </label>
                <input type="" name="TenTL" placeholder="Nhập tên thể loại" value="{{ $row->TenTL }}" class="form-control" required>
            </div>
            <div class="form-group mg-b-20">
                <label for="">Thứ tự:</label>
                <input type="number" name="ThuTu" placeholder="Nhập thứ tự" value="{{ $row->ThuTu }}" class="form-control">
            </div>
        </div>
        <div class="d-flex justify-content-around">
            <div class="d-flex form-group mg-b-20">
                <label class="rdiobox mx-4">
                    <input type="radio" name="AnHien" @if ($row->AnHien==1) checked @endif value="1">
                    <span>Hiện</span>
                </label> &nbsp;
                <label class="rdiobox">
                    <input type="radio" name="AnHien" @if ($row->AnHien==0) checked @endif value="0">
                    <span>Ẩn</span>
                </label>
            </div>
            <div class="d-flex form-group mg-b-20">
                <label class="rdiobox mx-4">
                    <input type="radio" name="lang" @if ($row->lang=='vi') checked @endif value="vi">
                    <span>Tiếng Việt</span>
                </label> &nbsp;
                <label class="rdiobox">
                    <input type="radio" name="lang" @if ($row->lang=='en') checked @endif value="en">
                    <span>English</span>
                </label>
            </div>

            <div class="d-flex form-group mg-b-20">
                <label class="rdiobox mx-4">
                    <input type="radio" name="HienMenu" @if ($row->HienMenu==1) checked @endif value="1">
                    <span>Hiện trên menu</span>
                </label> &nbsp;
                <label class="rdiobox">
                    <input type="radio" name="HienMenu" @if ($row->HienMenu==0) checked @endif value="0">
                    <span>Ẩn trên menu</span>
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Lưu database</button>
    </div>
</form>

@endsection
