@extends('admin.layouts.admin')
@push('custom-style')
<link rel="stylesheet" href="{{ asset('css/admin/edit-account-details.css') }}">
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 offset-md-5">
            <div class="change-account-details-container">
                {!! Form::open(array('route' => 'updateAccountdetails','class'=> 'edit-account-form-block', 'method'=>'POST', 'enctype' => 'multipart/form-data',)) !!}
                    @csrf 
                    <h3>Change Account Details</h3>
                    <p class="restricted">* Email Address change restricted.</p>
                    <div class="form-group">
                        <input type="email" name="email" disabled id="" value="{{$user->email}}">
                        
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Enter your name" name="name" id=""  value="{{$user->name}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="display_name" id="" placeholder="Enter your Username" value="{{$user->display_name}}">
                        @error('display_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="Submit" class="btn btn-primary">Save changes</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection   
    