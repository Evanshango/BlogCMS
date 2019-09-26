@extends('layouts.app')

@section('content')
    @include('errors.errors')
    <div class="card">
        <div class="card-header">
            <b>{{isset($category) ? 'Update Category ': 'Create a Category'}}</b> {{isset($category) ? $category->name : ''}}
        </div>
        <div class="card-body">
            <form
                action="{{isset($category) ? route('category.update', ['id' => $category->id]) : route('category.store')}}"
                method="POST">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name"><b>Name</b></label>
                    <input type="text" id="name" name="name" value="{{isset($category) ? $category->name : ''}}" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        {{isset($category) ? 'Update Category' : 'Create Category'}}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
