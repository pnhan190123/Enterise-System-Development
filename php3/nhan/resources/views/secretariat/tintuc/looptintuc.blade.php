@php
    use App\Models\theloai;
@endphp
<table id="datatable1" class="table display table-bordered responsive nowrap table-responsive">
    <thead>
      <tr>
        <th>STT</th>
        <th width="120px">idTin/Ngày</th>
        <th width ="2500px">Tiêu đề/Tóm tắt</th>
        <th width="500px">Chỉnh/xóa</th>
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
            <div class="anhien">{{ ($item->AnHien==1) ? "Tin đang hiện" : "Đang ẩn" }}</div>
            <div class="nb">@if ($item->TinNoiBat==1) Tin nổi bật @else Tin bình thường @endif</div>
            <a href="{{ route('tintucSecretariat.edit', $item->idTin) }}" class="btn btn-primary">Xem</a>
            <form action="{{ route('tintucSecretariat.destroy', $item->idTin) }}" method="post" style="display: inline-block;">
                {{ csrf_field() }}
                {!! method_field('delete') !!}
                <button type="submit" onclick="return confirm('Xóa hả');" class="btn btn-danger">Không duyệt</button>
            </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
