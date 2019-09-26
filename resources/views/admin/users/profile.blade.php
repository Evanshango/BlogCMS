@extends('layouts.app')

@section('content')
    @include('errors.errors')
    <div class="card">
        <div class="card-header">
            <b>Update Profile</b>
        </div>
        <div class="card-body">
            <form action="{{route('user.profile.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name"><b>Username</b></label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="email"><b>Email</b></label>
                    <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}">
                </div>
                <div class="form-group">
                    <label for="password"><b>New Password</b></label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="avatar"><b>Upload new Photo</b></label>
                    <input type="file" id="avatar" name="avatar" class="form-control">
                </div>
                <div class="form-group">
                    <label for="facebook"><b>Facebook profile</b></label>
                    <input type="text" id="facebook" name="facebook" class="form-control" value="{{$user->profile->facebook}}">
                </div>
                <div class="form-group">
                    <label for="youtube"><b>Youtube profile</b></label>
                    <input type="text" id="youtube" name="youtube" class="form-control" value="{{$user->profile->youtube}}">
                </div>
                <div class="form-group">
                    <label for="about"><b>About you</b></label>
                    <textarea name="about" id="about" cols="5" rows="2" class="form-control">{{$user->profile->about}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm"><b>Update Profile</b></button>
                </div>
            </form>
        </div>
    </div>
@endsection

