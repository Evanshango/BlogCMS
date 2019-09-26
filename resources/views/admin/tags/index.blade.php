@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header"><b>Tags</b></div>
        <div class="card-body">
            @if($tags->count() > 0)
                <table class="table">
                    <thead>
                    <th>Tag Name</th>
                    <th>Post Count</th>
                    <th>Editing</th>
                    <th>Trash</th>
                    </thead>
                    <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>
                                {{$tag->name}}
                            </td>
                            <td>
                                0 Posts
                            </td>
                            <td>
                                <a href="{{route('tag.edit', $tag->id)}}" class="btn btn-sm btn-info"
                                   style="color: #fff">Edit</a>
                            </td>
                            <td>
                                <a href="{{route('tag.delete', $tag->id)}}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No Tags</h3>
            @endif
        </div>
    </div>
@endsection
