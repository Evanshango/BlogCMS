@extends('layouts.app')

@section('content')
    @include('errors.errors')
    <div class="card">
        <div class="card-header">
            <b>{{isset($post) ? 'Edit Post' : 'Create Post'}}</b>
        </div>
        <div class="card-body">
            <form action="{{isset($post) ? route('post.update', $post->id) : route('post.store')}}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title"><b>Title</b></label>
                    <input type="text" id="title" name="title" class="form-control"
                           value="{{isset($post) ? $post->title : ''}}">
                </div>
                @if(isset($post))
                    <div class="form-group">
                        <div class="text-center">
                            <img src="{{asset($post->featured)}}" alt="loading" width="40%" height="300px">
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label for="featured"><b>Featured</b></label>
                    <input type="file" id="featured" name="featured" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category_id"><b>Category</b></label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                @if(isset($post))
                                    @if($category->id === $post->category_id)
                                        selected
                                    @endif
                                @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags"><b>Choose tags</b></label>
                    <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}"
                                @if(isset($post))
                                    @if($post->hasTag($tag->id))
                                        selected
                                    @endif
                                @endif
                            >{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="contents"><b>Content</b></label>
                    <textarea id="contents" name="contents" cols="5" rows="10"
                              class="form-control">{{isset($post) ? $post->contents : ''}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        {{isset($post) ? 'Update Post' : 'Create Post'}}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script>
        $(document).ready(function () {
            $('.tags-selector').select2();
        })
        $(document).ready(function () {
            $('#contents').summernote();
        })
    </script>
@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet"/>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
@endsection
