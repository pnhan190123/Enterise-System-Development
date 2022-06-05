
<?php
    use App\Http\Controllers\homeController;
?>
@extends('site.layout')

@section('title')
    Liên Hệ
@endsection
@section('main')

    <div class="section-type-a" style="padding-top: 30px">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="contacts-item"><i class="icon pe-7s-map-marker color-primary"></i>
                        <div class="decor-center bg-primary"></div>
                        <div class="contacts-item__title">Trụ sở chính</div>
                        <div class="contacts-item__info">Tầng 5, Tòa nhà FPT, 17 phố <br> Duy Tân Cầu Giấy, Hà Nội</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contacts-item"><i class="icon pe-7s-call color-7"></i>
                        <div class="decor-center bg-7"></div>
                        <div class="contacts-item__title">Điện thoại</div>
                        <div class="contacts-item__info">(84+) 965 266 666 <br> 0989 899 999</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contacts-item"><i class="icon pe-7s-mail-open-file color-13"></i>
                        <div class="decor-center bg-13"></div>
                        <div class="contacts-item__title">email</div>
                        <div class="contacts-item__info">ngaymoi.express@gmail.com <br> ngaymoi.express.domain@gmail.com</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contacts-item"><i class="icon pe-7s-clock color-3"></i>
                        <div class="decor-center bg-3"></div>
                        <div class="contacts-item__title">Giờ làm việc</div>
                        <div class="contacts-item__info">Từ thứ 2 - thứ 6, 7h sáng - 5h Chiều<br> Thứ 7 - Chủ Nhật : 10h sáng - 4h chiều
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-type-f">
        <div class="container">
            <div class="row">
                <div class="col-xs-12" style="margin-top: 60px">
                    <h2 class="ui-title-block text-center" style="padding-bottom: 40px"><span class="ui-title-block__subtitle">Liên Hệ Chúng Tôi</span><span
                            class="text-uppercase">Gửi nội dung</span></h2>
                    <form action="{{ url('/site/lienhe') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" placeholder="Họ Tên" name="hoten" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="email" placeholder="Địa chỉ email" name="email" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="tel" placeholder="Số điện thoại" name="sdt" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="Tiêu đề" name="tieude" class="form-control">
                            </div>
                            <div class="col-xs-12">
                                <textarea rows="5" placeholder="Nội dung" name="noidung" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 170px">
                            <div class="col-sm-6 col-sm-offset-3">
                                <button class="ui-form__btn btn btn-sm btn-info btn-full btn-effect"><i
                                        class="icon pe-7s-mail"></i>Gửi tin nhắn</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
