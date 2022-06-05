
<table id="datatable1" class="table display table-bordered responsive nowrap table-responsive">
    <thead>
      <tr>
        <th>STT</th>
        <th width="120px">Tên người dùng</th>
        <th width="250px">Loại Dịch Vụ</th>
        <th width="250px">Giá dịch vụ</th>
        <th width="250px">Ngày mua</th>
        <th width="500px">Duyệt/Không Duyệt</th>
        {{-- <th class="wd-25p">Lang</th>
        <th class="wd-15p">Ẩn hiện</th>
        <th class="wd-10p">Thể loại</th>
        <th class="wd-10p">Sửa</th>
        <th class="wd-10p">Xóa</th> --}}

      </tr>
    </thead>
    <tbody>
      @foreach($ds as $value)
      <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td style="white-space:normal">
           {{$value->hoten}}
        </td>
        <td style="white-space:normal">
         {{$value->loai}}
        </td>
        <td>
          {{$value->sotien}}
        </td>
        <td><?php
          $time =  $value->thoigianmua;
          echo date('r',$time);         
          
          ?>
          
        </td>
        <td style="white-space:normal">
         
            <a href="{{ route('Accountant.statusShow', $value->id_tong) }}" class="btn btn-primary">Duyệt</a>
            <form action="{{ route('Accountant.destroy',  $value->id_tong) }}" method="post" style="display: inline-block;">
                {{ csrf_field() }}
                {!! method_field('delete') !!}
                <button type="submit" onclick="return confirm('Bạn có chắc chắn xóa không?');" class="btn btn-danger">Không Duyệt</button>
            </form>
        </td>
     
      </tr>
      @endforeach
    </tbody>
  </table>
