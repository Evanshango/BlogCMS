@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header"><b>Users</b>
            <a class="btn btn-success btn-sm float-right" href="{{route('user.create')}}"><b>Add User</b></a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <th>Avatar</th>
                <th>Name</th>
                <th>Permissions</th>
                <th>Remove</th>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <img src="{{asset($user->profile->avatar)}}" alt="loading" width="50xp" height="50px"
                                 style="border-radius: 50%">
                        </td>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            @if($user->admin)
                                @if($user->id === 1)
                                    <b>ADMIN</b>
                                @else
                                    @if(Auth::id() !== $user->id)
                                        <a href="{{route('user.admin', $user->id)}}" class="btn btn-sm btn-info"
                                           style="color: #fff">Remove permissions</a>
                                    @endif
                                @endif
                            @else
                                <a href="{{route('user.admin', $user->id)}}" class="btn btn-sm btn-success">Make
                                    Admin</a>
                            @endif
                        </td>
                        <td>
                            @if($user->admin)
                            @else
                                @if(Auth::id() !== $user->id)
                                    <a href="{{route('user.delete', $user->id)}}"
                                       class="btn btn-sm btn-danger">Delete</a>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
