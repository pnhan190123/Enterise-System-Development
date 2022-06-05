@extends('editor.layout')

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

<form method="post" action="{{route('quangcaoEditor.updatelistNews', $row->id) }}">
    {{ csrf_field() }}
    {!! method_field('post') !!}
    <div class="col-9 mg-l-30" style="margin: 0 auto;">
        <div class="d-flex flex-column">
            <div class="form-group mb-b-20">
                <input type="hidden" value="{{$row->id}}" name="id">


                <label for="">
                    Tên loại quảng cáo: <span class="tx-danger">*</span>
                </label>
                <input type="text" name="ten_loai" placeholder="Nhập tên thể loại" value="{{ $row->ten_loai}}" class="form-control" required>
            </div>
            <div class="form-group mg-b-20">
                <label for="">Tiền loại quảng cáo:</label>
                <input type="number" name="gialoai" placeholder="Nhập tiền dịch vụ" value="{{ $row->gialoai}}" class="form-control">
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
      
        </div>
        <button type="submit" class="btn btn-primary">Lưu database</button>
    </div>
</form>

@endsection
