@extends('admin.layouts.app')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-block dashboard">
    <div class="title-section d-flex justify-content-between align-items-center pt-3 pb-2 mb-3">
		<div class="text-block">
			<h3>USER SECTION</h3>
			<h1 class="title">Users Update</h1>
		</div>
		<div class="btn-block">
			<a class="btn btn-primary" href="{{ route('users.create') }}">
				<ion-icon name="add-outline"></ion-icon>
				<span>Create a new user</span>
			</a>
		</div>
	</div>
    {!! Form::open(array('route' => ['users.update', $data->id], 'class'=> 'row g-3', 'method'=>'PUT', 'enctype' => 'multipart/form-data')) !!}
    @csrf
        <div class="col-md-8">
            {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
            {!! Form::text('name', $data->name, ['class' => 'form-control']) !!}
            @if($errors->has('name'))
                <div class="error_msg">
                    {{ $errors->first('name') }}
                </div>
            @endif
		</div>
        <div class="col-md-4">
            {!! Form::label('role', 'User Role', ['class' => 'form-label']) !!}
            <select name="role" class="form-select">
                @foreach($roles as $role)
                    @if($role->id == $data->roles->first()->id)
                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                    @else
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endif
                @endforeach
            </select>
		</div>
		<div class="col-md-12">
            {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
            {!! Form::email('email', $data->email, ['class' => 'form-control', 'id'=>'email', 'autocomplete' => 'on', 'required' => true]) !!}
            @if($errors->has('email'))
                <div class="error_msg">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <span class="loader-email-check"></span>
            <span  class="loader-email-box"> <i class="rito rito-check"></i></span>
		</div>
		<div class="col-md-6">
            {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
            {!! Form::password('password', ['class' => 'form-control', 'onkeyup' => 'passwordValidation(this)']) !!}
            <span class="invalid-feedback"></span>
            @if($errors->has('password'))
                <div class="error_msg">
                    {{ $errors->first('password') }}
                </div>
            @endif
		</div>
		<div class="col-md-6">
            {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'form-label']) !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            @if($errors->has('password_confirmation'))
            <div class="error_msg">
                {{ $errors->first('password_confirmation') }}
            </div>
            @endif
		</div>
		<div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ $data->is_active ? 'checked' : '' }}>
                {!! Form::label('is_active', 'User Active Status', ['class' => 'form-check-label']) !!}
			</div>
		</div>
		<div class="col-12">
			<button type="submit" class="btn btn-primary">Sign in</button>
		</div>
	{!! Form::close() !!}
</main>
@endsection
