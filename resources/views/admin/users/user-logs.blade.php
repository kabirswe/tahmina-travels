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
                <h1 class="title">User Logs</h1>
            </div>
        </div>
        <div class="row w-100">
            <div class="data-table-loader"></div>
            <table id="data-table" class="ui celled table responsive w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id</th>
                        <th>Log Name</th>
                        <th>Description</th>
                        <th>Subject Id</th>
                        <th>Subject Type</th>
                        <th>Created at</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </section>
</main>

<!-- Modal -->
<div class="modal fade" id="modal-log" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="user-info">
              <h3 class="user-title"></h3>
              <p class="user-role"></p>
              <p class="user-email"></p>
          </div>
          <div class="content-info">
              <p class="content-model"></p>
              <p class="log-name"></p>
              <p class="created-at"></p>
              <p class="description"></p>
              {{-- <blockquote>
                <pre> --}}
                  <code class="code"></code>
                {{-- </pre>
              </blockquote> --}}
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endsection

@push('custom-scripts')
<script src="{{ asset('vendor/datatable/datatables.min.js') }}" defer></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.semanticui.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js" defer></script>

<script type="text/javascript">

$(document).ready( function () {
    $(".data-table-loader").fadeOut();
    $("#data-table thead").fadeIn('slow');
    var table = $('#data-table').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        fixedHeader: true,
        "pageLength": 50,
        "lengthMenu": [100, 300, 500, 1000 ],
        ajax: {
            url: SITEURL + "/user/logs",
            type: 'GET'
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'id', name: 'id'},
            {data: 'log_name', name: 'log_name'},
            {data: 'description', name: 'description'},
            {data: 'subject_id', name: 'subject_id'},
            {data: 'subject_type', name: 'subject_type'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false}
        ],
        order: [[0, 'desc']]
    });

    $('body').on('click', '#viewData', function() {
        var dataId = $(this).data("id");
        $.ajax({
                type: "GET",
                url: SITEURL + "/user/log/show?id=" + dataId,
                success: function (response) {
                    console.log(response);
                    console.log(response.data.properties);
                    $('#modal-log').modal('show');
                    $('.user-title').html(response.user.name);
                    $('.user-role').html(response.role);
                    $('.user-email').html(response.user.email);
                    $('.user-create').html(response.user.created_at);
                    $('.content-model').html(response.data.causer_type);
                    $('.log-name').html(response.data.log_name);
                    $('.created-at').html(response.data.created_at);
                    $('.description').html(response.data.description);
                    $('.code').html(JSON.stringify(response.data.properties));
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
    });

    $('body').on('click', '#deleteData', function () {
        var dataId = $(this).data("id");
        var isDelete = confirm("Are you sure want to delete!");

        if(isDelete) {
            $.ajax({
                type: "GET",
                url: SITEURL + '/user/log/delete?id=' + dataId,
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
