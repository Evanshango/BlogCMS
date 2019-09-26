@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header"><b>Posts</b></div>
        <div class="card-body">
            @if($posts->count() > 0)
                <table class="table">
                    <thead>
                    <th>Image</th>
                    <th>Post Title</th>
                    <th>Editing</th>
                    <th>Trash</th>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <img src="{{asset($post->featured)}}" alt="{{$post->title}}" width="50px" height="50px"
                                     style="border-radius: 50%">
                            </td>
                            <td>
                                {{$post->title}}
                            </td>
                            @if($post->trashed())
                                <td>
                                    <form action="{{route('restore-posts', $post->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success" style="color: #fff">Restore
                                        </button>
                                    </form>
                                </td>
                            @else
                                <td>
                                    <a href="{{route('post.edit', $post->id)}}" class="btn btn-sm btn-info"
                                       style="color: #fff">Edit</a>
                                </td>
                            @endif
                            <td>
                                <a href="{{route('post.delete', $post->id)}}" class="btn btn-sm btn-danger">
                                    {{$post->trashed() ? 'Delete' : 'Trash'}}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No Posts</h3>
            @endif
        </div>
    </div>
@endsection
