<?php

use App\Models\quangcao;
use App\Models\quangcaobaibao;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

?>
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
    <tr>

      <?php
      if ($baibao != null) { ?>
        @foreach ($baibao as $item)

        <?php
        $check  = quangcaobaibao::find($item->id_quangcaobaibao);
        if ($check->idUser == Auth::id()) { ?>



          <td>
            <?php
            $quangcaobaibao =  quangcaobaibao::find($item->id_quangcaobaibao);
            if($quangcaobaibao !=  null){
                          $user           =  User::find($quangcaobaibao->id_editor);
                          if($user !=  null){
                                        echo $user->hoten;

                          }

            }
            ?>
          </td>
          <td style="white-space:normal">
            <div>
              <?php
              $quangcaobaibao =  quangcaobaibao::find($item->id_quangcaobaibao);
              echo $quangcaobaibao->loai_quangcao;
              ?></div>
          </td>
          <td style="white-space:normal">
            <?php
            $quangcaobaibao =  quangcaobaibao::find($item->id_quangcaobaibao); ?>
            <img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$quangcaobaibao->idUser}}/{{$quangcaobaibao->urlHinh}}" style="width: 200px;height:150px">
          </td>
          <td><?php
              $quangcaobaibao =  quangcaobaibao::find($item->id_quangcaobaibao);
              echo $quangcaobaibao->yeucau;
              ?></td>
          <td><?php
              if ($item->role_quangcao == 0) {
                echo "Đang đợi duyệt";
              } elseif ($item->role_quangcao != 0) {
                echo "Đã duyệt";
              }
              ?></td>
          <td>
            <?php if ($item->role_quangcao != 0) { ?>
              <a href="" class="btn btn-secondary">Chỉnh</a>
              <form action="" method="">
                {{ csrf_field() }}
                <button class="btn btn-secondary">Xóa</button>
              </form>
            <?php } else { ?>
              <a href="{{ route('quangcaoUser.editlist', $item->id) }}" class="btn btn-primary">Chỉnh</a>
              <form action="{{ route('quangcaoUser.destroylist', $item->id) }}" method="post">
                {{ csrf_field() }}
                {!! method_field('delete') !!}
                <button type="submit" onclick="return confirm('Vui lòng xác nhận xóa!');" class="btn btn-danger">Xóa</button>
              </form>
            <?php } ?>
          </td>
    </tr>




  <?php     }

  ?>
  @endforeach
<?php }
      if ($img != null) { ?>

  @foreach ($img as $value)
  <?php
        $checkimg =  quangcao::find($value->id_quangcao);
        if ($checkimg->idUser ==  Auth::id()) { ?>

    <tr>
      <td>
        <?php
          $quangcao =  quangcao::find($value->id_quangcao);
          if ($quangcao != null) {
            $user =  User::find($quangcao->id_editor);
            if ($user !=  null) {
              echo ($user->hoten);
            }
          }
        ?>
      </td>
      <td style="white-space:normal">
        <div> <?php
              $quangcao =  quangcao::find($value->id_quangcao);

              echo $quangcao->loai_quangcao;

              ?></div>
      </td>
      <td style="white-space:normal">
        <?php
          $quangcao =  quangcao::find($value->id_quangcao);
        ?>
        <img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$quangcao->idUser}}/{{$quangcao->urlHinh}}" style="width: 200px;height:150px">
      </td>
      <td><?php
          $quangcao =  quangcao::find($value->id_quangcao);
          echo  $quangcao->yeucau;
          ?></td>
      <td><?php
          if ($value->role_quangcao == 0) {
            echo "Đang đợi duyệt";
          } elseif ($value->role_quangcao != 0) {
            echo "Đã duyệt";
          }
          ?></td>
      <td>
        <?php
          if ($value->role_quangcao != 0) { ?>
          <a href="" class="btn btn-secondary">Chỉnh</a>
          <form action="" method="">
            {{ csrf_field() }}
            <button class="btn btn-secondary">Xóa</button>
          </form>
        <?php } else { ?>
          <a href="{{ route('quangcao.edit', $value->id_quangcao) }}" class="btn btn-primary">Chỉnh</a>
          <form action="{{ route('quangcao.destroy', $value->id_quangcao) }}" method="post">
            {{ csrf_field() }}
            {!! method_field('delete') !!}
            <button type="submit" onclick="return confirm('Vui lòng xác nhận xóa!');" class="btn btn-danger">Xóa</button>
          </form>
        <?php }
        ?>
      </td>
    <?php }
    ?>
    </tr>
    @endforeach


  <?php  }

  ?>

  </tbody>
</table>