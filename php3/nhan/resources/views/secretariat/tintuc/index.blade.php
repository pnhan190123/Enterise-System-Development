@extends('secretariat.layout')

@section('pagetitle', 'DANH SÁCH TIN')

@section('main')
@include('secretariat/tintuc/looptintuc')
@endsection

@section('js')
<script src="{{ asset('lib') }}/datatables/jquery.dataTables.js"></script>
<link rel="stylesheet" href="{{ asset('lib') }}/datatables/jquery.dataTables.css">
<script>
    $(document).ready(function() {
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
