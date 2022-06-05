@extends('admin.layout')

@section('pagetitle', 'SỬA LOẠI TIN')

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

<form method="post" action="{{ route('loaitin.update', $row->idLT) }}">
    {{ csrf_field() }}
    {!! method_field('patch') !!}
    <div class="col-6 mg-l-30" style="margin: 0 auto;">
        <div class="d-flex flex-column">
            <div class="form-group mg-b-20">
                <label>Tên loại tin: <span class="tx-danger">*</span></label>
                <input type="text" name="Ten" value="{{ $row->Ten }}" placeholder="Nhập tên loại tin" class="form-control" required>
            </div>
            <div class="form-group mg-b-20">
                <label>Thứ tự:</label>
                <input type="number" name="ThuTu" value="{{ $row->ThuTu }}" placeholder="Nhập thứ tự" class="form-control">
            </div>
        </div>
        <div class="d-flex justify-content-around">
            <div class="d-flex form-group mg-b-20">
                <label class="rdiobox  mx-4">
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
        </div>
        <select class="form-control mg-b-20" name="idTL" id="">
            @php
                $kq = DB::select('select idTL, TenTL from theloai order by ThuTu');
            @endphp
            @foreach ($kq as $rowTL)
                @if ($row->idTL == $rowTL->idTL)
                <option value="{{ $rowTL->idTL }}" checked>{{ $rowTL->TenTL }}</option>
                @else
                <option value="{{ $rowTL->idTL }}">{{ $rowTL->TenTL }}</option>
                @endif
            @endforeach

        </select>
        <button type="submit" class="btn btn-primary mt-3">LƯU DATABASE</button>
    </div>
</form>
@endsection
