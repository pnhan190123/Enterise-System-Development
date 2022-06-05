@extends('secretariat.layout')

@section('pagetitle')
    secretariat
@endsection

@section('main')
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Thể Loại</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countTheloai }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Loại Tin</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countLoaitin }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-indent fa-2x text-gray-300" aria-hidden="true"></i>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Thành Viên
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $countUser }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-user-circle-o  fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Tin Tức</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countTin }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-newspaper-o fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $namePage }}</h6>
            </div>
            <div class="card-body">
                @include('secretariat/tintuc/looptintuc')

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
