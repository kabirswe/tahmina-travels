@extends('admin.layouts.app')

@push('custom-style')
<!-- <link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.semanticui.min.css">
@endpush

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-block dashboard">
    <section class="main-content">
        <div class="title-section d-flex justify-content-between align-items-center pt-3 pb-2 mb-3">
            <div class="text-block">
                <h3>PERMISSIONS SECTION</h3>
                <h1 class="title">Unblock user account</h1>
            </div>
        </div>
        <div class="row w-100">
            <table id="data-table" class="ui celled table responsive w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date and time</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </section>
</main>

@endsection
@push('custom-scripts')
<script src="{{ asset('vendor/datatable/datatables.min.js') }}" defer></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.semanticui.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js" defer></script>
<script type="text/javascript">
var SITEURL = '{{ URL::to('') }}';

$(document).ready( function () {
    $(".data-table-loader").fadeOut();
    $("#data-table thead").fadeIn('slow');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('#data-table').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        ajax: {
            url: SITEURL + "/block/user/list",
            type: 'GET'
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false},
            {data: 'name', name: 'name', orderable: false},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at',  orderable: false},
            {data: 'action-btn', name: 'action-btn', orderable: false}
        ],
        order: [[0, 'desc']],
        // "language": {
        //     "lengthMenu": "公開 _MENU_ エントリー",
        //     "zeroRecords": no_data_found,
        //     "info": "表示中のページ _PAGE_ of _PAGES_",
        //     "infoEmpty": "利用可能な記録はありません",
        //     "sSearch": "探す:",
        //     "sProcessing":    "処理...",
        //     "sLoadingRecords": "レコードの読み込み...",
        //     "infoFiltered": "(からフィルタリング _MAX_ 総記録)",
        //     "oPaginate": {
        //         "sFirst":    "最初",
        //         "sLast":    "最終",
        //         "sNext":    "次",
        //         "sPrevious": "前"
        //     }
        // }
    });

    $('body').on('click', '#deleteData', function () {
        var dataId = $(this).data("id");
        var isDelete = confirm("Are you sure want to delete!");

        if(isDelete) {
            $.ajax({
                type: "DELETE",
                url: "{{route('unblock.user')}}",
                data:{
                    "email":dataId
                },
                success: function (data) {
                    var oTable = $('#data-table').dataTable();
                    oTable.fnDraw(false);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });

});

</script>
@endpush
