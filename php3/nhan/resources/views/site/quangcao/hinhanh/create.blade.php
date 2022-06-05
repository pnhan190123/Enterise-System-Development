@extends('site.quangcao.layout')
<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

?>
@section('pagetitle', 'THÊM TIN MỚI')

@section('main')
<style>
    .d-flex.justify-content-around {
        background-color: beige;
        padding-top: 5px;
        padding-bottom: 5px;
        border-radius: 5px;
    }
</style>

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

<form method="post" action="{{ route('quangcao.store') }}">
    {{ csrf_field() }}
    <div class="container">
        <center>
            <h1>
                <b>
                    <i>
                        Quảng cáo bằng hình ảnh
                    </i>
                </b>
            </h1>
        </center>
        <br>
        <hr>
        <br>
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
                <input id="thumbnail" class="form-control" type="text" name="urlHinh">
            </div>
            <div id="holder" style="text-align: center;">
            </div>
            {{-- <input type="text" name="urlHinh" placeholder="Nhập địa chỉ hình" required class="form-control"> --}}
        </div>


        <div class="d-flex justify-content-around">

            @php
            $kq = DB::select('select id, ten_loai, gialoai from loaiquangcao');
            @endphp
            @foreach($kq as $value)
            <div class="d-flex form-group mg-b-20">
                <label class="rdiobox">
                    <input type="radio" name="id_loaiquangcao" value="{{$value->id}}" required>
                    <span>{{$value->ten_loai}}<br>({{$value->gialoai}}$)</span>
                </label> &nbsp;
            </div>
            @endforeach

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




        <p style="text-align:center"><span style="font-size:14pt"><span style="font-family:&quot;Times New Roman&quot;,serif"><strong><span style="font-size:13.0pt"><span style="font-family:&quot;Tahoma&quot;,sans-serif">CỘNG H&Ograve;A X&Atilde; HỘI CHỦ NGHĨA VIỆT NAM</span></span></strong></span></span></p>

        <p style="text-align:center"><span style="font-size:14pt"><span style="font-family:&quot;Times New Roman&quot;,serif"><strong><span style="font-size:13.0pt"><span style="font-family:&quot;Tahoma&quot;,sans-serif">Độc lập - Tự do - Hạnh ph&uacute;c</span></span></strong></span></span></p>

        <p><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-size:13.0pt"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;***********</span></span></span></span></p>

        <p><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-size:13.0pt"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;HỢP ĐỒNG DỊCH VỤ QUẢNG C&Aacute;O THƯƠNG MẠI</span></span></span></span></p>

        <h1><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Số: [SO HD]/HĐQC</span></span></span></h1>

        <p><span style="font-size:12pt"><span style="font-family:VNI-Times"><em><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- Căn cứ Luật thương mại nước Cộng h&ograve;a X&atilde; hội chủ nghĩa Việt Nam.</span></em></span></span></p>

        <p><span style="font-size:12pt"><span style="font-family:VNI-Times"><em><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - Căn cứ Nghị định [SO NGHI DINH]/CP ng&agrave;y [NGAY THANG NAM] của Ch&iacute;nh phủ hướng dẫn thi h&agrave;nh Luật thương mại.</span></em></span></span></p>

        <p><span style="font-size:12pt"><span style="font-family:VNI-Times"><em><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- Căn cứ [VĂN BẢN HƯỚNG DẪN C&Aacute;C CẤP C&Aacute;C NG&Agrave;NH)</span></em></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><em><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;H&ocirc;m nay ng&agrave;y [NGAY THANG NAM] tại [DIA DIEM] ch&uacute;ng t&ocirc;i gồm c&oacute;:</span></em></span></span></p>

        <h3 style="text-align:justify"><strong><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">B&Ecirc;N THU&Ecirc; QUẢNG C&Aacute;O</span></span></span></strong></h3>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp;T&ecirc;n người thuê: <?php


                                                                                                                                                                                                            $tmp =  User::find(Auth::id());
                                                                                                                                                                                                            echo ($tmp->hoten) ?></span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp;Địa chỉ trụ sở ch&iacute;nh: <?php


                                                                                                                                                                                                                $tmp =  User::find(Auth::id());
                                                                                                                                                                                                                echo ($tmp->diachi) ?></span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp;Điện thoại: <?php


                                                                                                                                                                                                $tmp =  User::find(Auth::id());
                                                                                                                                                                                                echo ($tmp->sdt) ?></span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp;T&agrave;i khoản số: 5214 Mở tại ng&acirc;n h&agrave;ng: BIDV </span></span></span></p>


        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><strong><em><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp;Trong hợp đồng n&agrave;y gọi tắt l&agrave; b&ecirc;n A</span></em></strong></span></span></p>

        <h3 style="text-align:justify"><strong><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">B&Ecirc;N NHẬN DỊCH VỤ QUẢNG C&Aacute;O</span></span></span></strong></h3>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; T&ecirc;n doanh nghiệp: CÔNG TY TNHH TRUYỀN THÔNG BÁO CHÍ NGÀY MỚI </span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; Địa chỉ trụ sở ch&iacute;nh: QUẬN 7 , HỒ CHÍ MINH</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; Điện thoại: 09868686868 Telex: 8640241972 Fax: 425151645 </span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; T&agrave;i khoản số: 45827441 Mở tại ng&acirc;n h&agrave;ng: VPBANK (NGÂN HÀNG VIỆT NAM THỊNH VƯỢNG) </span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; Đại diện l&agrave; &Ocirc;ng (b&agrave;): PHẠM THÀNH NHÂN Chức vụ: TỔNG GIÁM ĐỐC </span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; Viết ng&agrave;y <b>24/12/2017</b> Do <b>PHẠM THÀNH NHÂN</b> chức vụ <b>TỔNG GIÁM ĐỐC</b> k&yacute;.</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><strong><em><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp;Trong hợp đồng n&agrave;y gọi tắt l&agrave; b&ecirc;n B</span></em></strong></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; Sau khi b&agrave;n bạc thảo luận hai b&ecirc;n đồng &yacute; k&yacute; hợp đồng quảng c&aacute;o với những nội dung v&agrave; điều khoản sau:</span></span></span></p>

        <h4 style="text-align:justify"><strong><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">Điều 1: Nội dung c&ocirc;ng việc</span></span></span></strong></h4>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<em>H&igrave;nh thức</em>: B&ecirc;n A thu&ecirc; b&ecirc;n B l&agrave;m dịch vụ quảng c&aacute;o [TEN H&Agrave;NG H&Oacute;A, SẢN PHẨM, DỊCH VỤ) bằng h&igrave;nh thức </span></span><span style="font-family:&quot;Tahoma&quot;,sans-serif">[H&Igrave;NH THỨC: QUẢNG C&Aacute;O TR&Ecirc;N WEBSITE BÁO ĐIỆN TỬ]</span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<em>Nội dung</em>: Được hai b&ecirc;n thỏa thuận c&oacute; phụ lục đ&iacute;nh k&egrave;m ph&ugrave; hợp với ph&aacute;p luật hiện h&agrave;nh.</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<em>Chi tiết quảng c&aacute;o</em>: Phụ lục đ&iacute;nh k&egrave;m v&agrave; kh&ocirc;ng t&aacute;ch rời khỏi hợp đồng.</span></span></span></p>

        <h4 style="text-align:justify"><strong><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">Điều 2: Phương thức, phương tiện quảng c&aacute;o</span></span></span></strong></h4>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 1 &ndash; <em>Phương thức</em>: Y&ecirc;u cầu n&ecirc;u được h&igrave;nh thức, chất lượng bằng h&igrave;nh ảnh, biểu tượng, &acirc;m thanh, lời n&oacute;i&hellip; c&oacute; sức hấp dẫn l&ocirc;i cuốn kh&aacute;ch h&agrave;ng.</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2 &ndash; <em>Phương tiện</em>: Y&ecirc;u cầu quay h&igrave;nh ảnh, vẽ biển hiệu, pan&ocirc;, &aacute;p ph&iacute;ch, bảng c&oacute; hộp đ&egrave;n, chữ nổi, hay tr&ecirc;n b&aacute;o ch&iacute;, tạp ch&iacute;, truyền h&igrave;nh&hellip;</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><strong><span style="font-family:&quot;Tahoma&quot;,sans-serif">Điều 3: Ph&iacute; dịch vụ v&agrave; phương thức thanh to&aacute;n</span></strong></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;1 &ndash; Tổng chi ph&iacute; dịch vụ theo hợp đồng l&agrave;: <? ?> đồng (viết bằng chữ).</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp;Trong đ&oacute; bao gồm:</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp;- Ph&iacute; dịch vụ quảng c&aacute;o l&agrave;: [SO TIEN] đồng</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp;- Chi ph&iacute; về nguy&ecirc;n, vật liệu l&agrave;: [SO TIEN] đồng</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; - C&aacute;c chi ph&iacute; kh&aacute;c (nếu c&oacute;) l&agrave;: [SO TIEN] đồng</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp;2 &ndash; B&ecirc;n A thanh to&aacute;n cho b&ecirc;n B bằng đồng Việt Nam bằng h&igrave;nh thức (chuyỂn khoẢn, tiỀn mẶt] v&agrave; được chia ra l&agrave;m lần.</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp;Lần thứ nhất: [SO TIEN] </span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp;Lần thứ hai: [SO TIEN] </span></span></span></p>

        <h4 style="text-align:justify"><strong><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">Điều 4: Quyền v&agrave; mghĩa vụ của b&ecirc;n A</span></span></span></strong></h4>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; - B&ecirc;n A c&oacute; nghĩa vụ cung cấp th&ocirc;ng tin trung thực, ch&iacute;nh x&aacute;c về hoạt động sản xuất, h&agrave;ng h&oacute;a dịch vụ thương mại của đơn vị m&igrave;nh v&agrave; chịu tr&aacute;ch nhiệm về c&aacute;c th&ocirc;ng tin do m&igrave;nh cung cấp cho b&ecirc;n B.</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp;- B&ecirc;n A c&oacute; quyền lựa chọn h&igrave;nh thức, nội dung, phương tiện, phạm vi v&agrave; thời hạn quảng c&aacute;o thương mại.</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">- Khi c&oacute; sự tranh chấp của b&ecirc;n thứ ba về những nội dung th&ocirc;ng tin kinh tế, nh&atilde;n hiệu h&agrave;ng h&oacute;a, bản quyền&hellip; đối với b&ecirc;n A th&igrave; b&ecirc;n A phải tự m&igrave;nh giải quyết, trong trường hợp đ&oacute; b&ecirc;n B c&oacute; quyền đơn phương đ&igrave;nh chỉ hợp đồng v&agrave; y&ecirc;u cầu b&ecirc;n A chịu tr&aacute;ch nhiệm bồi thường chi ph&iacute; cho b&ecirc;n B (nếu c&oacute;).</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp;- B&ecirc;n A c&oacute; quyền kiểm tra, gi&aacute;m s&aacute;t việc thực hiện hợp đồng dịch vụ quảng c&aacute;o theo nội dung, điều khoản đ&atilde; k&yacute; kết.</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp;- Trả ph&iacute; dịch vụ quảng c&aacute;o theo thỏa thuận n&ecirc;u tại Điều 2 của hợp đồng.</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><strong><span style="font-family:&quot;Tahoma&quot;,sans-serif">Điều 5: Quyền v&agrave; nghĩa vụ của b&ecirc;n B</span></strong></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp;Y&ecirc;u cầu b&ecirc;n thu&ecirc; quảng c&aacute;o thương mại cung cấp th&ocirc;ng tin quảng c&aacute;o trung thực, ch&iacute;nh x&aacute;c theo đ&uacute;ng thời hạn của hợp đồng .</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; Thực hiện dịch vụ quảng c&aacute;o thương mại theo đ&uacute;ng thỏa thuận trong hợp đồng.</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp;Được nhập khẩu vật tư, nguy&ecirc;n liệu v&agrave; c&aacute;c sản phẩm quảng c&aacute;o thương mại cần thiết cho hoạt động dịch vụ quảng c&aacute;o của m&igrave;nh theo quy định của ph&aacute;p luật.</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; Nhận ph&iacute; quảng c&aacute;o theo thỏa thuận trong hợp đồng.</span></span></span></p>

        <h4 style="text-align:justify"><strong><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">Điều 6: Điều khoản về tranh chấp</span></span></span></strong></h4>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp;1/ Hai b&ecirc;n cần chủ động th&ocirc;ng b&aacute;o cho nhau biết tiến độ thực hiện hợp đồng, nếu c&oacute; vấn đề bất lợi g&igrave; ph&aacute;t sinh, c&aacute;c b&ecirc;n phải kịp thời b&aacute;o cho nhau biết v&agrave; chủ động b&agrave;n bạc giải quyết tr&ecirc;n cơ sở thương lượng đảm bảo hai b&ecirc;n c&ugrave;ng c&oacute; lợi (c&oacute; lập bi&ecirc;n bản ghi to&agrave;n bộ nội dung đ&oacute;).</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp;2/ Trường hợp c&oacute; nội dung tranh chấp kh&ocirc;ng tự giải quyết được th&igrave; hai b&ecirc;n thống nhất sẽ khiếu nại tới t&ograve;a &aacute;n [TEN TOA AN] l&agrave; cơ quan c&oacute; thẩm quyền giải quyết.</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp;3/ C&aacute;c chi ph&iacute; về kiểm tra, x&aacute;c minh v&agrave; lệ ph&iacute; t&ograve;a &aacute;n do b&ecirc;n c&oacute; lỗi chịu.</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><strong><span style="font-family:&quot;Tahoma&quot;,sans-serif">Điều 7: Thời hạn c&oacute; hiệu lực hợp đồng</span></strong></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp;Hợp đồng n&agrave;y c&oacute; hiệu lực từ ng&agrave;y [NGAY THANG NAM] đến ng&agrave;y [NGAY THANG NAM]. Hai b&ecirc;n sẽ tổ chức họp v&agrave; lập bi&ecirc;n bản thanh l&yacute; hợp đồng sau đ&oacute; [SO NGAY] ng&agrave;y. B&ecirc;n B c&oacute; tr&aacute;ch nhiệm tổ chức v&agrave;o thời gian, địa điểm th&iacute;ch hợp.</span></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; Hợp đồng n&agrave;y được l&agrave;m th&agrave;nh [SO BAN] bản c&oacute; gi&aacute; trị như nhau, mỗi b&ecirc;n giữ [SO BAN] bản.</span></span></span></p>

        <p style="text-align:justify">&nbsp;&nbsp;</p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><strong><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ĐẠI DIỆN B&Ecirc;N B&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;ĐẠI DIỆN B&Ecirc;N A</span></strong></span></span></p>

        <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:VNI-Times"><strong><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></strong><span style="font-family:&quot;Tahoma&quot;,sans-serif">Tổng gi&aacute;m đốc&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span></span><span style="font-family:&quot;Tahoma&quot;,sans-serif">Chức vụ</span></span></p>

        <p style="text-align:justify"><em><span style="font-size:12.0pt"><span style="font-family:&quot;Tahoma&quot;,sans-serif">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (K&yacute; t&ecirc;n, đ&oacute;ng dấu)</span></span></em></p>

        <p style="text-align:justify">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (Đ&atilde; k&yacute;)</p>

        <p style="text-align:justify">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="font-family:Tahoma,sans-serif; font-size:14pt">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><span style="font-size:12.0pt"><span style="font-family:&quot;Tahoma&quot;,sans-serif"><span style="font-size:10px"><img alt="" src="http://localhost:8080/php3/nhan/storage/app/public/photos/42/signature.png" style="float:left; height:221px; width:534px" /></span></span></span></p>

        <p style="text-align:justify">&nbsp;</p>

        <p style="text-align:justify">&nbsp;</p>

        <p style="text-align:justify">&nbsp;</p>

        <p style="text-align:justify">&nbsp;</p>

        <p style="text-align:justify">&nbsp;</p>

        <p style="text-align:justify">&nbsp; &nbsp; &nbsp; &nbsp;</p>
        <br>
        <br>
        <p style="text-align:justify"><span style="font-family:Tahoma,sans-serif; font-size:14pt">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Phạm Th&agrave;nh Nh&acirc;n&nbsp; &nbsp; </span></p>


        <div class="form-group mg-b-20">

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
        <br>
        <input type="checkbox" required> Tôi xác nhận đồng ý với tất cả điều khoản và hợp đồng trên
        <br>
        <br>
        <button type="submit" class="btn btn-primary" style="float: right;">
            Gửi yêu cầu
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