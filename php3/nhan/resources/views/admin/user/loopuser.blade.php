@php
use App\Models\theloai;
@endphp
<style>

form#active {
    margin-left: -108px;
}
select.btn.w-50 {
    background-color: papayawhip;
}
button#not{
    margin-left: 87px;
}
</style>
<table id="datatable1" class="table display responsive nowrap">
  <thead>
    <tr>
      <th class="wd-15p">ID</th>
      <th class="wd-15p">Tên người dùng</th>
      <th class="wd-20p">Vai trò</th>
      <th class="wd-25p">Email</th>
      {{-- <th class="wd-25p">Số điện thoại</th> --}}
      <th class="wd-20p">Chỉnh Chức Vụ</th>
      <th class="wd-10p">Xóa</th>

    </tr>
  </thead>
  <tbody>
    @foreach ($ds as $item)
    <tr>
      <td>{{ $item->idUser }}</td>
      <td>{{ $item->hoten }}</td>
      <td class="text-start">
        <?php
        if ($item->idgroup == 1) {
          echo "Phóng Viên";
        } elseif ($item->idgroup == 2) {
          echo "Biên Tập Viên";
        } elseif ($item->idgroup == 3) {
          echo "Ban Thư Kí";
        } elseif ($item->idgroup == 5) {
          echo "Kế Toán";
        } else {
          echo "Người dùng";
        }

        ?>
      </td>
      <td>{{ $item->email }}</td>
    
      <td>
        @php
        ($item->active==1) ? $active = 0 : $active = 1
        @endphp
        <form class="w-100" action="{{ route('user.active', [$item->idUser, $active]) }}" method="post" id="active">
          {{ csrf_field() }}
          <?php
            if($item->idgroup != 5){?>
                 <select name="chucvu" class="btn w-50">
              <option value="1" >Phóng Viên</option>
              <option value="2">Biên Tập Viên</option>
              <option value="3">Ban Thư Kí</option>
              <option value="0">Người Dùng</option>

            </select>
            <button type="submit" class="btn w-50 textcenter- btn-{{ ($item->active==1) ? "primary" : "dark" }}">{{ ($item->active==1) ? "Kích hoạt" : "Kích hoạt" }}</button>

          <?php  
            }else{?>
              <button type="submit"  id="not"class="btn w-50 textcenter- btn-{{ ($item->active==1) ? "primary" : "dark" }}">{{ ($item->active==1) ? "Kích hoạt" : "Không" }}</button>

            <?php }
          ?>
          
        </form>
      </td>
      <td>
        <form action="{{ route('user.destroy', $item->idUser) }}" method="post">
          {{ csrf_field() }}
          {!! method_field('delete') !!}
          <button type="submit" onclick="return confirm('Xóa hả');" class="btn btn-danger">Xóa</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>