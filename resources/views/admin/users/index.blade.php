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
                <h3>USER SECTION</h3>
                <h1 class="title">Users List</h1>
            </div>
            <div class="btn-block">
                <a class="btn" href="{{ route('users.create') }}">
                    <ion-icon name="add-outline"></ion-icon>
                    <span>Create a new user</span>
                </a>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row w-100">
            <table id="data-table" class="ui celled table responsive w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Role</th>
                        <th>Active</th>
                        <th>Action</th>
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
    var listUrl = SITEURL + '/users';
    var statusUrl = SITEURL + '/users/change/status';

    $(document).ready( function () {
        var table = $('#data-table').DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            fixedHeader: true,
            "pageLength": 20,
            "lengthMenu": [ 20, 50, 100, 500 ],
            ajax: {
                url: listUrl,
                type: 'GET'
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true },
                { data: 'name', name: 'name', orderable: true },
                { data: 'email', name: 'email', orderable: true },
                {
                    "data": "role_names", "defaultContent": ""
                },
                {
                    data: 'status-data',
                    orderable: false,
                    render: function (data) {
                        var name;
                        if(data.status == 1) {
                            name = 'check.svg';
                        } else {
                            name = 'cross.svg';
                        }
                        return '<div id="status-' + data.id + '"><img data-id="' + data.id + '" data-status="' + data.status + '" src="' + ASSET_URL + 'images/admin/' + name + '" class="icon-img status-change" alt="acive or inactive"></div>';
                    }
                },
                {
                    data: 'action-btn',
                    orderable: false,
                    render: function (data) {
                        var btn = '';
                        btn += '<a href="' + listUrl + '/' + data + '" class="btn btn-dt-detail">Detail</a>';
                        btn += '<a href="' + listUrl + '/' + data + '/edit" class="btn btn-dt-edit">Edit</a>';
                        return btn;
                    }
                }
            ],
            order: [[0, 'desc']]
        });

        $('body').on('click', '.status-change', function () {
            var id = $(this).data('id');
            var status = $(this).data('status');
            $('#status-' + id).html('<div class="loader"></div>');
            var value, name;
            if(status == 1) {
                value = 0;
                name = 'cross.svg';
            } else {
                value = 1;
                name = 'check.svg';
            }
            $.ajax({
                type: "GET",
                dataType: "json",
                url: statusUrl,
                data: {'status': value, 'id': id},
                success: function(data) {
                    $('#status-' + id).html('<img data-id="' + id + '" data-status="' + value + '" src="' + ASSET_URL + 'images/admin/' + name + '" class="icon-img status-change" alt="acive or inactive">');
                }
            });
        });
    });
</script>
@endpush
