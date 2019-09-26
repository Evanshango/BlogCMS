@extends('layouts.app')

@section('content')
    @include('errors.errors')
    <div class="card">
        <div class="card-header">
            <b>{{isset($tag) ? 'Update Tag ': 'Create a Tag'}}</b> {{isset($tag) ? $tag->name : ''}}
        </div>
        <div class="card-body">
            <form
                action="{{isset($tag) ? route('tag.update', $tag->id) : route('tag.store')}}"
                method="POST">
                @csrf
                @if(isset($tag))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name"><b>Name</b></label>
                    <input type="text" id="name" name="name" value="{{isset($tag) ? $tag->name : ''}}" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        {{isset($tag) ? 'Update Tag' : 'Create Tag'}}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
