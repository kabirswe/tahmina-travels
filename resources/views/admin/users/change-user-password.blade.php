@extends('admin.layouts.admin')
@push('custom-style')
<link rel="stylesheet" href="{{ asset('css/admin/login-password.css') }}">
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 offset-md-5">    
            <div class="changepasscontainer">
                <form class="edit-pass-form-block" method='POST' action="{{ route('change.password') }}">
                    @csrf 
                    <h3>Change Password</h3> 
                    <div class="form-group">
                        <input type="password"class="@error('old_password') is-invalid @enderror" placeholder="Enter your old password" name="old_password" id=""  value="">
                        @error('old_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="@error('password') is-invalid @enderror" id="" placeholder="Enter your new password" value="">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="@error('password_confirmation') is-invalid @enderror" id="" placeholder="Re-enter new password" value="">
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="Submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div> 
@endsection