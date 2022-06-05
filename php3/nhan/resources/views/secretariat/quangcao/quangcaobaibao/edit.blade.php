
@extends('editor.layout')

@section('pagetitle', 'SỬA TIN TỨC')
<style>
    .d-flex.justify-content-around {
    background-color: beige;
    padding-top: 150px;
    padding-bottom: 136px;
    border-radius: 5px;
}
</style>
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


    <form method="post" action="{{ route('quangcaoEditor.update', $row->id) }}">
        {{ csrf_field() }}
        {!! method_field('PUT') !!}
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
            <input type="text" name="yeucau" class="form-control" value="{{$row->yeucau}}" required>
        </div>
            <div class="form-group mg-b-20">
                
                <div class="input-group">
                    <span class="input-group-btn btn-primary">
                        <a id="button-thumbnail" style="color: white;" data-input="thumbnail" data-preview="holder"
                            class="btn btn-default">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    
                    <input id="thumbnail" value="{{ $row->urlHinh }}" class="form-control" type="text" name="urlHinh">
                    
                </div>
                <hr>
        
                <div id="holder" style="text-align: center;">
                <img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$row->idUser}}/{{$row->urlHinh}}" style="width: 200px;height:200px">
                </div>
                {{-- <input type="text" name="urlHinh" placeholder="Nhập địa chỉ hình" required class="form-control"> --}}
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
    <br>
    <hr>

            

            <div class="form-group mg-b-20">
            <textarea id="Content" name="noidung" rows="3">{{$row->noidung}}</textarea>

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

            <button type="submit" class="btn btn-primary" style="float: right;">
                NHẬN
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
