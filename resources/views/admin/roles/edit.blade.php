@extends('admin.layouts.app')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-block dashboard">
    <section class="main-content">
        <div class="title-section d-flex justify-content-between align-items-center pt-3 pb-2 mb-3">
            <div class="text-block">
                <h3>PERMISSIONS SECTION</h3>
                <h1 class="title">Users Permissions Update</h1>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {!! Form::model($role, ['method' => 'PATCH', 'class'=> 'row g-3 mt-4', 'route' => ['roles.update', $role->id]]) !!}
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">User Role</label>
            <div class="col-3">
                <select class="form-select" id="dynamic_select" name="name">
                    @foreach($roleSelect as $item)
                        @if($item->id == $role->id)
                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-2">
            @foreach ($permissions as $permission)
            <div class="col-6">
                <div class="form-check">
                    {!! Form::checkbox('permission[]', $permission->id, in_array($permission->id, $rolePermissions) ? true : false, ['class' => 'form-check-input', 'id' => $permission->name.$permission->id]) !!}
                    {!! Form::label($permission->name.$permission->id, $permission->name, ['class' => 'form-check-label']) !!}
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center d-flex justify-content-center mt-5">
            <button type="submit" class="btn btn-info">
                <span>Update</span>
            </button>
        </div>
        {!! Form::close() !!}
    </section>
</main>

@endsection

@push('custom-scripts')
<script type="text/javascript">
    $(document).ready( function () {
        $('#dynamic_select').on('change', function () {
            var data = $(this).val();
            var url = SITEURL + '/roles/' + data + '/edit';
            if (url) {
                window.location = url;
            }
            return false;
        });
    });
</script>
@endpush
