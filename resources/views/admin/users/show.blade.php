@extends('admin.layouts.app')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-block dashboard">
    <div class="title-section d-flex justify-content-between align-items-center pt-3 pb-2 mb-3">
        <div class="text-block">
            <h3>USER SECTION</h3>
            <h1 class="title">Users Detail</h1>
        </div>
        <div class="btn-block">
            <a class="btn" href="{{ route('users.index') }}">
                <ion-icon name="chevron-back-outline"></ion-icon>
                <span>Back</span>
            </a>
            <a class="btn" href="{{ route('users.edit', $user->id) }}">
                <ion-icon name="create-outline"></ion-icon>
                <span>Edit this user</span>
            </a>
            <a class="btn" href="{{ route('users.create') }}">
                <ion-icon name="add-outline"></ion-icon>
                <span>Create a new user</span>
            </a>
        </div>
    </div>
    <div class="col-lg-12 margin-tb d-flex justify-content-between">
        <div class="pull-left">
            <h2 class="title-text"> Show User</h2>
        </div>
        <div class="pull-right right-group-btn">
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $user->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {{ $user->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Roles:</strong>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success">{{ $v }}</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

