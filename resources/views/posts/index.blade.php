@extends('layouts.app')
@section("content")
    <section>
        <h2>Recipes</h2>
    <div class="recipes">
        @if(count($posts)>0)
        {{--looping through the posts array--}}
            @foreach( $posts as $post)
            {{--for each post we access the data it has, we use the OOP object notation $post->property--}}
                <div class="recipe">
                    <div class="image">
                        <a href="{{ route('posts.show',[$post ->id]) }}">
                            <div class="outcover" style='background:url("/storage/covers/{{$post->cover}}")center;background-size:100%'></div>
                        </a>
                    </div>
                    <div class="meta">
                        <p class="title">{{ $post->title }}</p>
                        <p> Recipe by: <strong>{{$post->user->name}}</strong></p>
                        <p class="description"> {{str_limit($post->description,62)}}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    </section>
 @endsection