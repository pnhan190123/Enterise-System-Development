<table id="datatable1" class="table display table-bordered responsive nowrap table-responsive">
    <thead>
      <tr>
        <th class="wd-15p">ID</th>
        <th class="wd-15p">Tên Phóng viên</th>
        <th class="wd-15p">Tên người dùng  bình luận</th>
        <th class="wd-20p">Tên tin tức</th>
        <th>Nội dung</th>
        <th class="wd-10p" style="width: 10%;">Ẩn hiện</th>
        <th class="wd-10p">Xóa</th>

      </tr>
    </thead>
    <tbody>
    @foreach ($ds as $item)
      <tr>
        <td>{{ $item->idYKien }}</td>
        <td style="white-space:normal">{{ $item->tenphongvien }}</td>
        <td style="white-space:normal">{{ $item->tenuser }}</td>
        <td style="white-space:normal">{{ $item->tin }}</td>
        <td style="white-space:normal">{{ $item->NoiDung }}</td>
        <td>
            @php
                ($item->AnHien==1) ? $AnHien = 0 : $AnHien = 1
            @endphp
            <form class="w-100" action="{{ route('ykien.statusShow', [$item->idYKien, $AnHien]) }}" method="post">
                {{ csrf_field() }}

                <button type="submit" class="btn w-100 text-center btn-{{ ($item->AnHien==1) ? "primary" : "dark" }}">{{ ($item->AnHien==1) ? "Đang hiện" : "Ẩn" }}</button>
            </form>
        </td>
        <td>
            <form action="{{ route('ykien.destroy', $item->idYKien) }}" method="post">
                {{ csrf_field() }}
                {!! method_field('delete') !!}
                <button type="submit" onclick="return confirm('Xóa hả');" class="btn btn-danger">Xóa</button>
            </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
