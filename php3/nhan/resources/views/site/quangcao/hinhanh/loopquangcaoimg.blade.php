@php
use App\Models\loaiquangcao;
use App\Models\quangcao;
use Illuminate\Support\Facades\Auth;

@endphp
<style>
  button.btn.btn-danger {
    margin-left: 74px;
    margin-top: -64px;
  }

  button.btn.btn-secondary {
    margin-left: 74px;
    margin-top: -64px;
  }

  td {
    width: 30%;
  }
</style>
<table id="datatable1" class="table display table-bordered responsive nowrap table-responsive">
  <thead>
    <tr>
      <th width="100px">Tên "Biên Tập Viên" Nhận Bài</th>
      <th width="120px">Loại Quảng cáo</th>
      <th width="160px">Ảnh quảng cáo</th>
      <th width="160px">Yêu cầu của khách hàng</th>
      <th>Trạng Thái</th>
      <th width="250px">Chỉnh/xóa</th>

    </tr>
  </thead>
  <tbody>
    @foreach ($ds as $item)
    <?php


    $check =  quangcao::find($item->id_quangcao);
    if ($check->idUser ==  Auth::id()) { ?>
      <tr>
        <td>
          <?php
          if ($item->id_editor == 0) { ?>
            Chưa có biên tập viên nhận
          <?php } elseif ($item->id_editor != 0) { ?>
            {{$hoten}}
          <?php }
          ?>

        </td>
        <td style="white-space:normal">
          <div>{{ $item->loai_quangcao}}</div>
        </td>
        <td style="white-space:normal">

          <img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$item->idUser}}/{{$item->urlHinh}}" style="width: 200px;height:150px">
        </td>
        <td>{{$item->yeucau}}</td>

        <td><?php
            if ($item->role_quangcao == 0) {
              echo "Đang đợi duyệt";
            } elseif ($item->role_quangcao != 0) {
              echo "Đã duyệt";
            }
            ?></td>

        <td>
          <?php
          if ($item->role_quangcao != 0) { ?>
            <a href="" class="btn btn-secondary">Chỉnh</a>
            <form action="" method="">
              {{ csrf_field() }}
              <button class="btn btn-secondary">Xóa</button>
            </form>
          <?php } else { ?>
            <a href="{{ route('quangcao.edit', $item->id_quangcao) }}" class="btn btn-primary">Chỉnh</a>
            <form action="{{ route('quangcao.destroy', $item->id_quangcao) }}" method="post">
              {{ csrf_field() }}
              {!! method_field('delete') !!}
              <button type="submit" onclick="return confirm('Vui lòng xác nhận xóa!');" class="btn btn-danger">Xóa</button>
            </form>

          <?php }

          ?>
        </td>

      </tr>
    <?php }


    ?>

    @endforeach
  </tbody>
</table>