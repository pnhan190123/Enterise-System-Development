@extends('secretariat.layout')

@section('pagetitle', 'THÊM TIN MỚI')

@section('main')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach (@errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="post" action="{{ route('tintucSecretariat.store') }}">
    {{ csrf_field() }}
    <div class="container">
        <input type="hidden" name="idUser" value="{{ auth()->user()->idUser }}">
        <div class="form-group mg-b-20">
            <input type="text" name="TieuDe" class="form-control" placeholder="Nhập tiêu đề tin" required id="">
        </div>

        <div class="form-group mg-b-20">
            <textarea name="TomTat" placeholder="Nhập tóm tắt của tin" class="form-control" rows="5"></textarea>
        </div>

        <div class="form-group mg-b-20">
            <div class="input-group btn-primary">
                <span class="input-group-btn">
                    <a id="button-thumbnail" style="color: white;" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                    </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="urlHinh">
            </div>
            <div id="holder" style="text-align: center;">
            </div>
            {{-- <input type="text" name="urlHinh" placeholder="Nhập địa chỉ hình" required class="form-control"> --}}
        </div>

        <div class="d-flex justify-content-around">
            <div class="d-flex form-group mg-b-20">
                <label class="rdiobox">
                    <input type="radio" name="AnHien" value="1" checked>
                    <span>Hiện</span>
                </label> &nbsp;
                <label class="rdiobox">
                    <input type="radio" name="AnHien" value="0">
                    <span>Ẩn</span>
                </label>
            </div>
            <div class="d-flex form-group mg-b-20">
                <label class="rdiobox">
                    <input type="radio" name="lang" value="vi" checked>
                    <span>Tiếng Việt</span>
                </label> &nbsp;
                <label class="rdiobox">
                    <input type="radio" name="lang" value="en">
                    <span>English</span>
                </label>
            </div>

            <div class="d-flex form-group mg-b-20">
                <label class="rdiobox">
                    <input type="radio" name="NoiBat" value="1" checked>
                    <span>Nổi bật</span>
                </label> &nbsp;
                <label class="rdiobox">
                    <input type="radio" name="NoiBat" value="0">
                    <span>Bình thường</span>
                </label>

            </div>
        </div>


        <div class="d-flex justify-content-around">
            <div class="d-flex justify-content-around" style="width: 40%;">
                <div class="d-flex form-group mg-b-20 wd-350" style="width: 100%;">
                    <div class='input-group date' id='datetimepicker'>

                        <input type='text' class="form-control fc-datapicker" name="Ngày" placeholder="Nhập ngày đưa tin" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
              
                <script src="{{ asset('lib') }}/jquery-ui/jquery-ui.js"></script>
                <script src="{{ asset('lib') }}/select2/js/select2.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
                <script type="text/javascript">
                    $(function() {
                        $('#datetimepicker').datetimepicker();
                    });
                </script>
               
            </div>
            <div class="d-flex form-group mg-b-20 md-350" style="width: 40%;">
                <input type="text" name="tags" class="form-control" placeholder="Nhập tags của tin">
            </div>
        </div>

        <div class="d-flex justify-content-around">
            <div class="form-group wd-350" style="width: 40%;">
                <select name="idTL" class="form-control">
                    <option value="0">Chọn thể loại</option>
                    @php
                    $kq = DB::select('select idTL, TenTL from theloai');

                    @endphp
                    @foreach ($kq as $rowTL)
                    <option value="{{ $rowTL->idTL }}">{{ $rowTL->TenTL }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group wd-350" style="width: 40%;">
                <select name="idLT" class="form-control" style="width: 100%;">
                    <option value="0">Chọn loại tin</option>
                </select>
            </div>
        </div>

        <div class="form-group mg-b-20">
            {{-- <textarea name="Content" id="Content" placeholder="Nhập nội dung của tin" class="form-control" rows="3"></textarea> --}}
            <textarea id="Content" name="Content"></textarea>
            <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
            <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
            <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
            {{-- <script src="{{ asset('lib') }}/highlightjs/highlight.pack.js"></script>
            <script src="{{ asset('lib') }}/medium-editor/medium-editor.js"></script>
            <script src="{{ asset('lib') }}/summernote/summernote-bs4.min.js"></script>
            <link rel="stylesheet" href="{{ asset('lib') }}/highlightjs/github.css">
            <link rel="stylesheet" href="{{ asset('lib') }}/summernote/summernote-bs4.css"> --}}
            <script>
                $('#button-thumbnail').filemanager('image');

                $(document).ready(function() {
                    // Define function to open filemanager window
                    var lfm = function(options, cb) {
                        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
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
            LƯU DATABASE
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