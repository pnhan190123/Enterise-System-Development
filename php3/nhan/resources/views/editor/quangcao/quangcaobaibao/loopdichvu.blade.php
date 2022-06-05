

<table id="datatable1" class="table display responsive nowrap">
    <thead>
      <tr>
        <th class="wd-15p">STT</th>
        <th class="wd-15p">Tên loại quảng cáo</th>
        <th class="wd-20p">Tiền quảng cáo</th>
        <th class="wd-15p">Ẩn hiện</th>
        <th class="wd-10p">Sửa</th>
        <th class="wd-10p">Xóa</th>

      </tr>
    </thead>
    <tbody>
    @foreach ($ds as $item)
      <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $item->ten_loai}}</td>
        <td>{{ $item->gialoai}}$</td>

        <td>
            @php
                ($item->AnHien==1) ? $AnHien = 0 : $AnHien = 1
            @endphp
            <form class="w-100" action="{{ route('quangcaoEditor.changeStatusShowNews', [$item->id, $AnHien]) }}" method="post">
                {{ csrf_field() }}

                <button type="submit" class="btn w-50 text-center btn-{{ ($item->AnHien==1) ? "primary" : "dark" }}">{{ ($item->AnHien==1) ? "Đang hiện" : "Ẩn" }}</button>
            </form>
        </td>

        <td>
            <a href="{{ route('quangcaoEditor.editlistNews', $item->id) }}" class="btn btn-primary">Chỉnh</a>
        </td>
        <td>
            <form action="{{ route('quangcaoEditor.destroylistNews', $item->id) }}" method="post">
                {{ csrf_field() }}
                {!! method_field('delete') !!}
                <button type="submit" onclick="return confirm('Xóa hả');" class="btn btn-danger">Xóa</button>
            </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
