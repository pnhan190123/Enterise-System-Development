@php
    $URL = 'http://localhost:8088/php3/nhan/storage/app/public/photos/Auth::id()/';
@endphp
@extends('reporter.layout')

@section('pagetitle', 'SỬA TIN TỨC')

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


    <form method="post" action="{{ route('tintucReporter.update', $row->idTin) }}">
        {{ csrf_field() }}
        {!! method_field('PUT') !!}
        <div class="container">
            <div class="form-group mg-b-20">
                <input type="text" name="TieuDe" value="{{ $row->TieuDe }}" class="form-control"
                    placeholder="Nhập tiêu đề tin" required id="">
            </div>

            <div class="form-group mg-b-20">
                <textarea name="TomTat" placeholder="Nhập tóm tắt của tin" class="form-control"
                    rows="5">{{ $row->TomTat }}</textarea>
            </div>

            <div class="form-group mg-b-20">
            <div class="input-group btn-primary">
                <span class="input-group-btn">
                    <a id="button-thumbnail" style="color: white;" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                    </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="urlHinh" value="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$row->idUser}}/{{$row->urlHinh}}">
            </div>
            <div id="holder" style="text-align: center;">
            <input type="file" onchange="previewFile()" hidden ><br>
            <img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$row->idUser}}/{{$row->urlHinh}}" height="200" alt="Image preview...">
            </div>
            {{-- <input type="text" name="urlHinh" placeholder="Nhập địa chỉ hình" required class="form-control"> --}}
        </div>

            <div class="d-flex justify-content-around">
                <div class="d-flex form-group mg-b-20">
                    <label class="rdiobox">
                        <input type="radio" @if ($row->AnHien == 1) checked @endif name="AnHien" value="1">
                        <span>Hiện</span>
                    </label> &nbsp;
                    <label class="rdiobox">
                        <input type="radio" @if ($row->AnHien == 0) checked @endif name="AnHien" value="0">
                        <span>Ẩn</span>
                    </label>
                </div>
                <div class="d-flex form-group mg-b-20">
                    <label class="rdiobox">
                        <input type="radio" @if ($row->lang == 'vi') checked @endif name="lang" value="vi">
                        <span>Tiếng Việt</span>
                    </label> &nbsp;
                    <label class="rdiobox">
                        <input type="radio" @if ($row->lang == 'en') checked @endif name="lang" value="en">
                        <span>English</span>
                    </label>
                </div>

                <div class="d-flex form-group mg-b-20">
                    <label class="rdiobox">
                        <input type="radio" @if ($row->NoiBat == 1) checked @endif name="NoiBat" value="1">
                        <span>Nổi bật</span>
                    </label> &nbsp;
                    <label class="rdiobox">
                        <input type="radio" @if ($row->NoiBat == 0) checked @endif name="NoiBat" value="0">
                        <span>Bình thường</span>
                    </label>
                </div>
            </div>


            <div class="d-flex justify-content-around">
                <div class="d-flex justify-content-around"  style="width: 40%;">
                    <div class="d-flex form-group mg-b-20 wd-350" style="width: 100%;">
                        <span class="input-group-addon">
                            <i class="icon ion-calendar tx-16 lh-0 op-6"></i>
                        </span>

                        <input type="text" value="{{ $row->Ngay }}" name="Ngay" placeholder="Nhập ngày đưa tin"
                            class="form-control fc-datepicker">
                    </div>

                    <script src="{{ asset('lib') }}/jquery-ui/jquery-ui.js"></script>
                    <script src="{{ asset('lib') }}/select2/js/select2.min.js"></script>

                    <script>
                        $(function() {
                            $('.fc-datepicker').datepicker({
                                showOtherMonths: true,
                                selectOtherMonths: true,
                                dateFormat: 'dd/mm/yy'
                            });
                        })
                    </script>
                </div>
                <div class="d-flex form-group mg-b-20 md-350" style="width: 40%;">
                    <input type="text" name="tags" value="{{ $row->tags }}" class="form-control"
                        placeholder="Nhập tags của tin">
                </div>
            </div>

            <div class="d-flex justify-content-around">
                <div class="form-group wd-350" style="width: 40%">
                    <select name="idTL" class="form-control">
                        <option value="0">Chọn thể loại</option>
                        @php
                            $kq = DB::select('select idTL, TenTL from theloai');
                        @endphp
                        @foreach ($kq as $rowTL)
                            @if ($rowTL->idTL == $row->idTL)
                                <option selected value="{{ $rowTL->idTL }}">{{ $rowTL->TenTL }}</option>
                            @else
                                <option value="{{ $rowTL->idTL }}">{{ $rowTL->TenTL }}</option>
                            @endif

                        @endforeach
                    </select>
                </div>
                <div class="form-group wd-350" style="width: 40%">
                    <select name="idLT" class="form-control">
                        <option value="0">Chọn loại tin</option>
                        @php
                            $listLT = DB::select('select idLT, Ten from loaitin WHERE idTL=' . $row->idTL . ' order by ThuTu');
                        @endphp
                        @foreach ($listLT as $rowLT)
                            @if ($rowLT->idLT == $row->idLT)
                                <option selected value="{{ $rowLT->idLT }}">{{ $rowLT->Ten }}</option>
                            @else
                                <option value="{{ $rowLT->idLT }}">{{ $rowLT->Ten }}</option>
                            @endif

                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mg-b-20">
                <textarea id="Content" name="Content" row="3">{{ $row->Content }}</textarea>

                <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
                <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
                <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

                <script>
                    $('#button-thumbnail').filemanager('image');

                    $(document).ready(function() {
                        // Define function to open filemanager window
                        var lfm = function(options, cb) {
                            var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                            window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager',
                                'width=900,height=600');
                            window.SetUrl = cb;
                        };

                        // Define LFM summernote button
                        var LFMButton = function(context) {
                            var ui = $.summernote.ui;
                            var button = ui.button({
                                contents: '<i class="note-icon-picture"></i> ',
                                tooltip: 'Insert image with filemanager',
                                click: function() {

                                    lfm({
                                        type: 'image',
                                        prefix: '/laravel-filemanager'
                                    }, function(lfmItems, path) {
                                        lfmItems.forEach(function(lfmItem) {
                                            context.invoke('insertImage', lfmItem.url);
                                        });
                                    });

                                }
                            });
                            return button.render();
                        };

                        // Initialize summernote with LFM button in the popover button group
                        // Please note that you can add this button to any other button group you'd like
                        $('#Content').summernote({
                            toolbar: [
                                ['style', ['bold', 'italic', 'underline', 'clear']],
                                ['font', ['strikethrough', 'superscript', 'subscript']],
                                ['fontsize', ['fontsize']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['height', ['height']],
                                ['popovers', ['lfm']],
                            ],
                            buttons: {
                                lfm: LFMButton
                            }
                        })
                    });
                </script>
            </div>

            <button type="submit" class="btn btn-primary">
                CẬP NHẬT
            </button>
        </div>
    </form>
@endsection

@section('js')

    <script>
        $(document).ready(function() {
            $("[name='idTL']").change(function() {
                var idTL = $(this).val();
                var diachi = "http://127.0.0.1:8000/layloaitintrong1theloai/" + idTL;

                $("[name='idLT']").load(diachi);
            });
        });
    </script>

@endsection
