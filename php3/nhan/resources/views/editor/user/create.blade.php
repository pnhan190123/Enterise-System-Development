@extends('editor.layout')

@section('pagetitle', 'THÊM USER')

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

<form method="post" action="{{ route('loaitinEditor.store') }}">
    {{ csrf_field() }}
    <div class="col-6 mg-l-30" style="margin: 0 auto">
        <div class="d-flex flex-column">
            <div class="form-group mg-b-20">
                <label>Tên loại tin: <span class="tx-danger">*</span></label>
                <input type="text" name="Ten" placeholder="Nhập tên loại tin" class="form-control" required>
            </div>
            <div class="form-group mg-b-20">
                <label>Thứ tự:</label>
                <input type="number" name="ThuTu" placeholder="Nhập thứ tự" class="form-control">
            </div>
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
            <div class="d-flex form-group mg-b-20">
                <label class="rdiobox mx-4">
                    <input type="radio" name="lang" value="vi" checked>
                    <span>Tiếng Việt</span>
                </label> &nbsp;
                <label class="rdiobox">
                    <input type="radio" name="lang" value="en">
                    <span>English</span>
                </label>
            </div>
        </div>
        <select class="form-control mg-b-20" name="idTL" id="">
            <option value="0">Chọn thể loại</option>
            @php
                $kq = DB::select('select idTL, TenTL from theloai order by ThuTu');
            @endphp
            @foreach ($kq as $row)
                <option value="{{ $row->idTL }}">{{ $row->TenTL }}</option>
            @endforeach

        </select>
        <button type="submit" class="btn btn-primary mt-3">LƯU DATABASE</button>
    </div>
</form>
@endsection
