@php
    use App\Models\theloai;
@endphp
<table id="datatable1" class="table display responsive nowrap">
    <thead>
      <tr>
        <th class="wd-15p">ID</th>
        <th class="wd-15p">Tên thể loại</th>
        <th class="wd-20p">Thứ tự</th>
        <th class="wd-25p">Lang</th>
        <th class="wd-15p">Ẩn hiện</th>
        <th class="wd-10p">Thể loại</th>
        <th class="wd-10p">Sửa</th>
        <th class="wd-10p">Xóa</th>

      </tr>
    </thead>
    <tbody>
    @foreach ($ds as $item)
      <tr>
        <td>{{ $item->idLT }}</td>
        <td>{{ $item->Ten }}</td>
        <td>{{ $item->ThuTu }}</td>
        <td>{{ ($item->lang == 'vi') ? "Tiêng Việt" : "English"}}</td>
        <td>{{ ($item->AnHien==1) ? "Đang hiện" : "Đang ẩn" }}</td>
        <td>
            @php
               $idTL = $item->idTL;
               $tl = theloai::find($idTL);
               if ($tl == null) echo "Chưa có thể loại";
               else echo $tl->TenTL
            @endphp
        </td>
        <td>
            <a href="{{ route('loaitin.edit', $item->idLT) }}" class="btn btn-primary">Chỉnh</a>
        </td>
        <td>
            <form action="{{ route('loaitin.destroy', $item->idLT) }}" method="post">
                {{ csrf_field() }}
                {!! method_field('delete') !!}
                <button type="submit" onclick="return confirm('Xóa hả');" class="btn btn-danger">Xóa</button>
            </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
