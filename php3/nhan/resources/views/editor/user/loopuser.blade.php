@php
    use App\Models\theloai;
@endphp
<table id="datatable1" class="table display responsive nowrap">
    <thead>
      <tr>
        <th class="wd-15p">ID</th>
        <th class="wd-15p">Tên người dùng</th>
        <th class="wd-20p">Vai trò</th>
        <th class="wd-25p">Email</th>
        {{-- <th class="wd-25p">Số điện thoại</th> --}}
        <th class="wd-10p" style="width: 10%;">Kích hoạt</th>
        <th class="wd-10p">Xóa</th>

      </tr>
    </thead>
    <tbody>
    @foreach ($ds as $item)
      <tr>
        <td>{{ $item->idUser }}</td>
        <td>{{ $item->hoten }}</td>
        <td class="text-start"><?php 
          if($item->vaitro == 1){
              echo "Phóng Viên";
          }
        ?></td>
        <td>{{ $item->email }}</td>
        <td>
            @php
                ($item->active==1) ? $active = 0 : $active = 1
            @endphp
            <form class="w-100" action="{{ route('userEditor.active', [$item->idUser, $active]) }}" method="post">
                {{ csrf_field() }}
                <button type="submit" class="btn w-100 text-center btn-{{ ($item->active==1) ? "primary" : "dark" }}">{{ ($item->active==1) ? "Kích hoạt" : "Không" }}</button>
            </form>
        </td>
        <td>
            <form action="{{ route('userEditor.destroy', $item->idUser) }}" method="post">
                {{ csrf_field() }}
                {!! method_field('delete') !!}
                <button type="submit" onclick="return confirm('Xóa hả');" class="btn btn-danger">Xóa</button>
            </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
