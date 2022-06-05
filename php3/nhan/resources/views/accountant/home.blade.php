@extends('accountant.layout')

@section('pagetitle')
    accountant
@endsection

@section('main')

<hr>
<div class="row">
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $namePage }}</h6>
            </div>
            <div class="card-body">
                @include('accountant/checkservice/loopservice')

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('lib') }}/datatables/jquery.dataTables.js"></script>
<link rel="stylesheet" href="{{ asset('lib') }}/datatables/jquery.dataTables.css">
<script>
    $(function() {
        $('#datatable1').DataTable({
            responsive: true,
            pageLength: 5,
            language: {
                searchPlaceholder: 'Tìm kiếm...',
                sSearch: '',
                lengthMenu: '_MENU_item/page',
                paginate: {previous: " < ", next: " > "},
                lengthMenu: "Hiện _MENU_ tin trong mỗi trang",
                zeroRecords: "Không tìm thấy",
                info: "Đang hiện trang _PAGE_ trong _PAGES_ trang",
                infoEmpty: "Không có dòng nào",
                infoFiltered: "(Lọc trong _MAX_ tin)",
            }
        })
    });
</script>
@endsection
