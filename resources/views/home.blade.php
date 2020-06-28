@extends('layouts.app')

@section('content')

<section class="home">
<div class="avatarBackground">
    @if(Auth::user()->avatar == "default.png")
        <div class="avatar" style='background:url("{{asset("/public/images/default.png")}}") center;background-size:100%'></div>
    @else
        <!--once the user changed the profile avatar, we can access that from here
        using the avatar column-->
        <div class="avatar" style='background:url("storage/avatars/{{Auth::user()->avatar}}")center;background-size:100%'></div>
    @endif

</div>  
 
  <div class="ribbon">
  <!--We access the current user data using Auth:user->property or table value ,/groupproject/public/user/{{Auth::user()->id}}/edit-->
         <h2>Dashboard | <a href="{{ route('user.edit',[Auth::user()->id]) }}">Edit</a></h2>
         <h3>{{ Auth::user()->name }} </h3>
         <p>{{ Auth::user()->email }}</p>

  </div>
 
    <!-- there is a LOT of code, if you dont understand something
    tell me about it in the comments and I will make a vid just for that feature -->

    <!-- I think I forgot something -->
  <div>
    <h2>My Recipes</h2>
    <div class="myrepices-container">

    <!--we count the number of posts and display them here -->
    @if (count($posts) > 0)
      
        @foreach ($posts as $post )
         <div class="myrecipe">
            <a href="{{ route('posts.show',[$post ->id]) }}">
            <img src="storage/covers/{{$post->cover}}" ></a>
            <h3>{{$post->title}}</h3> 
            
        </div>   
        @endforeach
       
    @else
        <p>There are no recipes to show yet.</p>         
    @endif
   </div>
  </div>  

<!-- this is a little status message laravel includes with the home.blade -->
<div class="panel-body">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    You are logged in!
</div>

</section>
@endsection
