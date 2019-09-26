@extends('layouts.frontend')

@section('content')

    <div class="stunning-header stunning-header-bg-lightviolet">
        <div class="stunning-header-content">
            <h1 class="stunning-header-title">{{$category->name}}</h1>
        </div>
    </div>

    <div class="container">
        <div class="row medium-padding120">
            <main class="main">
                <div class="row">
                    <div class="case-item-wrap">
                        @if($category->posts->count() > 0)
                            @foreach($category->posts as $post)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="case-item">
                                        <div class="case-item__thumb">
                                            <img src="{{asset($post->featured)}}" alt="our case">
                                        </div>
                                        <h6 class="case-item__title text-center">
                                            <a href="{{route('post.single', $post->slug)}}">{{$post->title}}</a>
                                        </h6>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3 class="text-center">No posts</h3>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
