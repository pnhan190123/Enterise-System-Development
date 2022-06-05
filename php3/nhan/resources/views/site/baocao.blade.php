<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Báo Cáo</title>
</head>
<body>
    <div class="container">
        <h2 class="text-underline">ASM 3</h2>
        <h3>Chức năng đã làm</h3>
            <ul>
                <li>
                    hiện tin
                    <ul>
                        <li>Tin theo loại</li>
                        <li>Tin theo thể loại</li>
                        <li>Tin tuần trước</li>
                        <li>Tin đánh giá cao</li>
                        <li>Tin nổi bật</li>
                        <li>Tin mới</li>
                        <li>Tin liên quan</li>
                        <li>Tin theo xu hướng (tìm theo số lượt xem của loại tin đó)</li>
                    </ul>
                </li>
                <li>Search
                    <ul>
                        <li>Search theo tiêu đề</li>
                        <li>Search tags</li>
                    </ul>
                </li>
                <li>
                    Profile
                    <ul>
                        <li>Xem profile user</li>
                        <li>Sửa profile user (chỉ user đang đăng nhập đúng với user đang xem mới có thể sửa)</li>
                    </ul>
                </li>

                <li>
                    Ý kiến
                    <ul>
                        <li>Hiện ý kiến</li>
                        <li>Thêm ý kiến (Chỉ đăng nhập mới có thể thêm)</li>
                    </ul>
                </li>
                <li>
                    Slug
                    <ul>
                        <li>gắn link</li>
                        <li>tạo slug bảng thể loại</li>
                        <li>tạo slug loại tin</li>
                        <li>tạo slug tin</li>
                    </ul>
                </li>
                <li>
                    Tăng số lần xem tin mỗi khi click vào trang chi tiết
                </li>

                <li>
                    Quản lí (Có kiểm tra đăng nhập)
                    <ul>
                        <li>Bảng user (check còn ý kiến hay tin không nếu còn thì không xóa ngay được, xác nhận lần 2 nữa sẽ xóa tất cả của user đó)</li>
                        <li>Bảng ý kiến</li>
                    </ul>
                </li>
            </ul>
        <hr>

        <h2 class="text-underline">ASM 2</h2>
        <h3>Chức năng đã làm</h3>
        <hr>
        <ul>
            <li>1. Template tự chọn</li>
            <li>2. Kiếm tra đăng nhập và quyền admin</li>
            <li>3. Thêm/Chỉnh tin: có web editor, upload hình, chọn hình trong thư viện hình để lấy url</li>
            <li>4. Quản li</li>
                <ul>
                    <li>Bảng Tin</li>
                    <li>Bảng thể loại</li>
                    <li>Bảng loại tin</li>
                </ul>
            <li>5. Breakcum</li>
            <li>6. Thông báo sau khi thêm xóa sửa của các bảng</li>
            <li>7. Trang chủ của phần quản trị có thống kê số thể loại, số tin, số loại tin, số user…</li>
            <li>8. Việt hóa toàn bộ phần giao diện + định đạng cho đẹp</li>
            <li>7. Khi xóa tin thì check ý kiến</li>
            <li>8. Khi xóa loại tin thì check tin</li>
            <li>9. Khi xóa thể loại thì check loại tin</li>
        </ul>

        <hr>

        <h2>ASM 1</h2>
        <h3>Layout</h3>
        <hr>
        <ul>
            <li>Đỗ dữ liệu
                <ul>
                    <li>Menu</li>
                    <li>Menu khi bấm button</li>
                    <li>Phần aside</li>
                </ul>
            </li>
            <li>Thay các banner, logo</li>
            <li>Đổi font khác (font cũ lỗi)</li>
            <li>Gắn link chi tiết, link thể loại, link loại tin</li>
            <li>Breadcrumb</li>
            <li>Hiện số bình luận, tên người đăng, loại tin</li>
            <li>Việt hóa header footer</li>
            <li>Tin tuần trước, tin hot, tin đánh giá cao</li>
        </ul>

        <h3 style="margin-top: 40px;">Trang chủ</h3>
        <hr>
        <ul>
            <li>url: /site</li>
            <li>Đỗ dữ liệu</li>
            <li>Thay đổi banner</li>
            <li>Gắn link trang theo loại (thể loại, loại tin)</li>
            <li>Gắn link chi tiết tin</li>
            <li>Việt hóa</li>
            <li>Phân trang</li>
            <li>Đỗ dữ liệu lên menu</li>
            <li>Tin tuần trước, tin ngẫu nhiên, tin mới, tin hot, tin đánh giá cao, tin theo trend(tìm theo số lượt xem của loại tin đó)</li>
        </ul>

        <h3 style="margin-top: 40px;">Trang tin theo loại tin</h3>
        <hr>
        <ul>
            <li>url: /site/tin/theloai/loaitin/id</li>
            <li>Đỗ dữ liệu</li>
            <li>Gắn link trang theo loại (thể loại, loại tin)</li>
            <li>Hiện số bình luận, tên người đăng, loại tin</li>
            <li>Hiện nội dung bình luận của bài viết</li>
            <li>Hiện các tags</li>
            <li>Gắn link chi tiết tin</li>
            <li>Việt hóa</li>
            <li>Đỗ dữ liệu lên menu</li>
            <li>Phân trang</li>
        </ul>

        <h3 style="margin-top: 40px;">Trang tin theo thể loại</h3>
        <hr>
        <ul>
            <li>url: /site/tin/theloai/id</li>
            <li>Đỗ dữ liệu</li>
            <li>Gắn link trang theo loại (thể loại, loại tin)</li>
            <li>Hiện số bình luận, tên người đăng, loại tin</li>
            <li>Gắn link chi tiết tin</li>
            <li>Việt hóa</li>
            <li>Đỗ dữ liệu lên menu</li>
            <li>Phân trang</li>
        </ul>

        <h3 style="margin-top: 40px;">Trang tin chi tiết</h3>
        <hr>
        <ul>
            <li>url: /site/tin/chitiet/id</li>
            <li>Đỗ dữ liệu</li>
            <li>Gắn link trang theo loại (thể loại, loại tin)</li>
            <li>Gắn link chi tiết tin</li>
            <li>Việt hóa</li>
            <li>Đỗ dữ liệu lên menu</li>
            <li>nút like share facebook</li>
        </ul>

        <h3 style="margin-top: 40px;">Trang tin liên hệ</h3>
        <hr>
        <ul>
            <li>url: /site/tin/chitiet/id</li>
            <li>Việt hóa</li>
            <li>Gửi mail</li>
            <li>Thông báo gửi mail thành công</li>
        </ul>
        <br/>

        *Có hình thay thế khi nạp hình lỗi
        <hr>


        <br/>
        <br/>
        <br/>
    </div>
</body>
</html>
