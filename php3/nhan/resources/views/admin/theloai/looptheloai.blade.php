<table id="datatable1" class="table display responsive nowrap">
    <thead>
      <tr>
        <th class="wd-15p">ID</th>
        <th class="wd-15p">Tên thể loại</th>
        <th class="wd-20p">Thứ tự</th>
        <th class="wd-25p">Lang</th>
        <th class="wd-15p">Ẩn hiện</th>
        <th class="wd-10p">Hiện menu</th>
        <th class="wd-10p">Sửa</th>
        <th class="wd-10p">Xóa</th>

      </tr>
    </thead>
    <tbody>
    @foreach ($ds as $item)
      <tr>
        <td>{{ $item->idTL }}</td>
        <td>{{ $item->TenTL }}</td>
        <td>{{ $item->ThuTu }}</td>
        <td>{{ ($item->lang == 'vi') ? "Tiêng Việt" : "English"}}</td>
        <td>{{ ($item->AnHien==1) ? "Đang hiện" : "Đang ẩn" }}</td>
        <td>{{ ($item->HienMenu==1) ? "Hiện trên menu" : "Ẩn trên menu" }}</td>
        <td>
            <a href="{{ route('theloai.edit', $item->idTL) }}" class="btn btn-primary">Chỉnh</a>
        </td>
        <td>
            <form action="{{ route('theloai.destroy', $item->idTL) }}" method="post">
                {{ csrf_field() }}
                {!! method_field('delete') !!}
                <button type="submit" onclick="return confirm('Xóa hả');" class="btn btn-danger">Xóa</button>
            </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
