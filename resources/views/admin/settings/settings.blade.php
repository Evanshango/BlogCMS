@extends('layouts.app')

@section('content')
    @include('errors.errors')
    <div class="card">
        <div class="card-header">
            <b>Edit Site Settings</b>
        </div>
        <div class="card-body">
            <form action="{{route('settings.update')}}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="site_name"><b>Site Name</b></label>
                    <input type="text" id="site_name" name="site_name" class="form-control" value="{{$settings->site_name}}">
                </div>
                <div class="form-group">
                    <label for="contact_email"><b>Email</b></label>
                    <input type="email" id="contact_email" name="contact_email" class="form-control" value="{{$settings->contact_email}}">
                </div>
                <div class="form-group">
                    <label for="address"><b>Address</b></label>
                    <input type="text" id="address" name="address" class="form-control" value="{{$settings->address}}">
                </div>
                <div class="form-group">
                    <label for="contact_number"><b>Contact Phone</b></label>
                    <input type="text" id="contact_number" name="contact_number" class="form-control" value="{{$settings->contact_number}}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update Site Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

