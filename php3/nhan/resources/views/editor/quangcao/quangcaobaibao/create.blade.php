@extends('editor.quangcao.layout')

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

<form method="post" action="{{ route('quangcaoEditor.store') }}">
    {{ csrf_field() }}
    <div class="container">
    <center>
            <h1>
                <b>
                    <i>
                        Quảng cáo bằng bài báo
                    </i>
                </b>
            </h1>
        </center>
        <br>
        <hr>
        <input type="hidden" name="idUser" value="{{ auth()->user()->idUser }}">
        <div class="form-group mg-b-20">
            <input type="text" name="yeucau" class="form-control" placeholder="Nhập yêu cầu cần có trong bài báo" required id="">
        </div>

        

        <div class="form-group mg-b-20">
            <div class="input-group btn-primary">
                <span class="input-group-btn">
                    <a id="button-thumbnail" style="color: white;" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                    </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="urlHinh" placeholder="Nhập ảnh bìa">
            </div>
            <div id="holder" style="text-align: center;">
            </div>
            {{-- <input type="text" name="urlHinh" placeholder="Nhập địa chỉ hình" required class="form-control"> --}}
        </div>

    

        <div class="d-flex justify-content-around">
            <div class="d-flex justify-content-around" style="width: 40%;">
               
              
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
          
        </div>

        <center>
            <h1>
                <b>
                    <i>
                       Nhập thông tin cần thiết
                    </i>
                </b>
            </h1>
            <h2>
                <i>
                     Bao gồm(thông tin , nguồn gốc, ứng dụng, quá trình ra đời, địa chỉ, ...)
                    </i>
            </h2>
        </center>
        <div class="form-group mg-b-20">
        <textarea id="Content" name="noidung"></textarea>

            {{-- <textarea name="Content" id="Content" placeholder="Nhập nội dung của tin" class="form-control" rows="3"></textarea> --}}
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

        <button type="submit" class="btn btn-primary" style="float: right;">
            GỬI YÊU CẦU
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