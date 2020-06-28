@extends('layouts.app')
@section("content")
    <section>
        <h2>{{$post->title}}  <span>ready in {{ $post->preptime}} </span></h2>
        <div class="recipeContainer">   
            <div>
           
                <div class="cover" style='background:url("../storage/covers/{{$post->cover}}")center;background-size:100%'></div>
            </div>
            
            <div>
                <p class="title">Ingredients</p>
                <p>{{$post->ingredients}}</p>
            </div>
            <div>
                <p class="title">Description</p>
                <p>{{$post->description}}</p>
            </div>
            <div>
                <p class="title">Preparation</p>
                <p>{{$post->preparation}}</p>
            </div>
            <div>
                <p>Recipe by: <strong>{{$post->user->name}}</strong></p>
            </div>
            <!-- here is a sample of authorization 
                we check if the user is a guest, in this case that is not a guest
                and that the ID of the user is the same ID of the post in the user_id column
                which if its true, it belongs to the user, and can have access
                to the edit and delete buttons
            -->
            @if (!Auth::guest())
               @if (Auth::user()->id == $post->user_id)
                <div>
                    <p><a class="editPost" href="{{ route('posts.edit',[$post ->id]) }}">Edit this post</a></p>
                </div>       
               @endif 
            @endif
            
        </div>
    </section>
@endsection


