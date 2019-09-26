@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header"><b>Categories</b></div>
        <div class="card-body">
            @if($categories->count() > 0)
                <table class="table">
                    <thead>
                    <th>Category Name</th>
                    <th>Editing</th>
                    <th>Deleting</th>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{$category->name}}
                            </td>
                            <td>
                                <a href="{{route('category.edit', $category->id)}}" class="btn btn-sm btn-info"
                                   style="color: #fff">Edit</a>
                            </td>
                            <td>
                                <form action="{{route('category.delete', $category->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No Categories</h3>
            @endif
        </div>
    </div>
@endsection
