@extends('layouts.app')

@section('content')
    @include('errors.errors')
    <div class="card">
        <div class="card-header">
            <b>Create User</b>
        </div>
        <div class="card-body">
            <form action="{{route('user.store')}}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name"><b>Name</b></label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email"><b>Email</b></label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

