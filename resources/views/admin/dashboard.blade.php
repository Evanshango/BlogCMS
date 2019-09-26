@extends('layouts.app')

@section('content')
    <div class="col-md-3">
        <div class="card bg-info">
            <div class="card-header text-center" style="color: #fff">
                <b>POSTS</b>
            </div>
            <div class="card-body">
                <h3 class="text-center" style="color: #fff">{{$post_count}}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger">
            <div class="card-header text-center" style="color: #fff">
                <b>TRASH</b>
            </div>
            <div class="card-body">
                <h3 class="text-center" style="color: #fff">{{$trashed_count}}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success">
            <div class="card-header text-center" style="color: #fff">
                <b>USERS</b>
            </div>
            <div class="card-body">
                <h3 class="text-center" style="color: #fff">{{$user_count}}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info">
            <div class="card-header text-center" style="color: #fff">
                <b>CATEGORIES</b>
            </div>
            <div class="card-body">
                <h3 class="text-center" style="color: #fff">{{$category_count}}</h3>
            </div>
        </div>
    </div>
@endsection
