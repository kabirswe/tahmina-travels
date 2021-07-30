@extends('admin.layouts.admin')
@push('custom-style')
<link rel="stylesheet" href="{{ asset('css/admin/account_settings.css') }}">
@endpush
@section('content')
<section id="setting_contents">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-5">
                @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')}}
                </div>
                @endif
                <h2>Account Settings</h2>
                <hr>
                <div class="row">
                    <div class="col-md-4 imgUp">
                        <div class="imagePreview text-center"></div>
                            <label class="upload_text ">
                                <span class="btn btn-upload"> Click to upload image  </span>
                                <input type="file" class="uploadFile img text-center" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                            </label>
                        </div>
                    <div class="col-md-8">
                        <div class="user_contents">
                            <div class="row">
                                <div class="col-6">
                                    <h5>Account Details:</h5>
                                    <ul>
                                        <li>
                                            Name:<span class="user_det"> {{$user->name}}</span>
                                        </li>
                                        <li>
                                            Username:<span class="user_det"> {{$user->display_name}}</span>
                                        </li>
                                        <li>
                                            Email:<span class="user_det"> {{$user->email}}</span>  
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <h5>Profile Details:</h5>
                                    <ul>
                                        <li>
                                            NID No:<span class="user_det"> {{$user->userProfile->nid_no}}</span>
                                        </li>
                                        <li>
                                            Passport No:<span class="user_det"> {{$user->userProfile->passport_no}}</span>
                                        </li>
                                        <li>
                                            Driving License:<span class="user_det"> {{$user->userProfile->driving_license_no}}</span>  
                                        </li>
                                    </ul>
                                </div>
                            </div> 
                            <hr>
                            <a href="{{route('editAccountdetails')}}" class="btn btn-info" >Change Account Details</a>
                            <a href="{{route('editProfile')}}" class="btn btn-success">Change Profile Details</a> 
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>  
</section>
@endsection


