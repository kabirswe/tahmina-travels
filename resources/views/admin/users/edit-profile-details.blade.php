@extends('admin.layouts.admin')
@push('custom-style')
<link rel="stylesheet" href="{{ asset('css/admin/edit-profile-details.css') }}">
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 offset-md-5">
            <div class="change-profile-details-container">
                {!! Form::open(array('route' => 'updateProfile','class'=> 'edit-profile-form-block', 'method'=>'POST', 'enctype' => 'multipart/form-data',)) !!}
                    @csrf 
                    <h3>Change Profile Details</h3>
                    <div class="form-group">
                    <input type="text" placeholder="Enter your NID NO" name="nid_no" id=""  value="{{$user->userProfile->nid_no}}">
                        @error('nid_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror                        
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Enter your Passport No" name="passport_no" id=""  value="{{$user->userProfile->passport_no}}">
                        @error('passport_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="driving_license_no" id="" placeholder="Enter your Driving License No" value="{{$user->userProfile->driving_license_no}}">
                        @error('driving_license_no')
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
    