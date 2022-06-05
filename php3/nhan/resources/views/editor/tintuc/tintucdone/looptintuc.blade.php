@php
use App\Models\theloai;
@endphp
<style>

  td{
    width: 10%;
  }
</style>
<table id="datatable1" class="table display table-bordered responsive nowrap table-responsive">
  <thead>
    <tr>
      <th>STT</th>
      <th width="120px">idTin/Ngày</th>
      <th>Tiêu đề/Tóm tắt</th>
      <th width="10px">Ảnh bài báo</th>
      <th width="250px">Chỉnh/xóa</th>
      {{-- <th class="wd-25p">Lang</th>
        <th class="wd-15p">Ẩn hiện</th>
        <th class="wd-10p">Thể loại</th>
        <th class="wd-10p">Sửa</th>
        <th class="wd-10p">Xóa</th> --}}

    </tr>
  </thead>
  <tbody>
    @foreach ($ds as $item)
    <tr>
      <td>{{ $loop->index + 1 }}</td>
      <td style="white-space:normal">
        <div>ID Tin: {{ $item->idTin }}</div>
        @php
        $newDate = date("d-m-Y", strtotime($item->Ngay));
        @endphp
        <div>{{ $newDate }}</div>
        <div>Xem: {{ $item->SoLanXem }}</div>
      </td>
      <td style="white-space:normal">
        <h5>{{ $item->TieuDe }}</h5>
        <p>{{ $item->TomTat }}</p>
      </td>
      <td style="white-space:normal">
        <img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$item->idUser}}/{{$item->urlHinh}}" style="width: 150px; height:150px;">
      </td>
      <?php
      if ($item->role_tin == 3) { ?>
         <td style="white-space:normal">
            <div class="anhien">{{ ($item->AnHien==1) ? "Tin đang hiện" : "Đang ẩn" }}</div>
            <div class="nb">@if ($item->TinNoiBat==1) Tin nổi bật @else Tin bình thường @endif</div>
            <a href="" class="btn btn-secondary">Xem</a>

            <form action="" method="post" style="display: inline-block;">
                {{ csrf_field() }}
           
                <button type="submit" onclick="return confirm('Xóa hả');" class="btn btn-secondary">Không duyệt</button>
            </form>
        </td>
      <?php } elseif ($item->role_tin == 2) { ?>

        <td style="white-space:normal">
            <div class="anhien">{{ ($item->AnHien==1) ? "Tin đang hiện" : "Đang ẩn" }}</div>
            <div class="nb">@if ($item->TinNoiBat==1) Tin nổi bật @else Tin bình thường @endif</div>
            <a href="{{ route('tintucEditor.edit', $item->idTin) }}" class="btn btn-primary">Xem</a>

            <form action="{{ route('tintucEditor.destroy', $item->idTin) }}" method="post" style="display: inline-block;">
                {{ csrf_field() }}
                {!! method_field('delete') !!}
                <button type="submit" onclick="return confirm('Xóa hả');" class="btn btn-danger">Không duyệt</button>
            </form>
        </td>
      <?php }

      ?>

    </tr>
    @endforeach
  </tbody>
</table>