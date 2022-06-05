

<table id="datatable1" class="table display responsive nowrap">
    <thead>
      <tr>
        <th class="wd-15p">ID Dịch Vụ</th>
        <th class="wd-15p">Tên Dịch Vụ</th>
        <th class="wd-20p">Tiền Dịch Vụ</th>
        <th class="wd-25p">Nội Dung</th>
        <th class="wd-25p">Thời gian</th>

        <th class="wd-15p">Ẩn hiện</th>
        <th class="wd-10p">Sửa</th>
        <th class="wd-10p">Xóa</th>

      </tr>
    </thead>
    <tbody>
    @foreach ($ds as $item)
      <tr>
        <td>{{ $item->id_DichVu }}</td>
        <td>{{ $item->ten_dv}}</td>
        <td>{{ $item->tien_dv}}</td>
        <td>{{ $item->noidung}}</td>
        <td>{{($item->thoigian)/86400}}</td>
        <td>
            @php
                ($item->AnHien==1) ? $AnHien = 0 : $AnHien = 1
            @endphp
            <form class="w-100" action="{{ route('serviceAccountant.statusShow', [$item->id_DichVu, $AnHien]) }}" method="post">
                {{ csrf_field() }}
                <button type="submit" class="btn w-100 text-center btn-{{ ($item->AnHien==1) ? "primary" : "dark" }}">{{ ($item->AnHien==1) ? "Đang hiện" : "Ẩn" }}</button>
            </form>
        </td>

        <td>
            <a href="{{ route('serviceAccountant.edit', $item->id_DichVu) }}" class="btn btn-primary">Chỉnh</a>
        </td>
        <td>
            <form action="{{ route('serviceAccountant.destroy', $item->id_DichVu) }}" method="post">
                {{ csrf_field() }}
                {!! method_field('delete') !!}
                <button type="submit" onclick="return confirm('Xóa hả');" class="btn btn-danger">Xóa</button>
            </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
