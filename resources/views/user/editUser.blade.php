@extends('layouts.app')
@section('content')

    <section class="edit">
           <h2>Edit <span> {{$user->name}} </span></h2>
           {{-- the action is to PUT to PostsController update function--}}
            {!! BF::open(['action' => ['UserController@update', $user->id ], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
               <div class="form-group">
                    {{BF::label('name','Username')}}
                    {{--this is how we pass the $post->property as a default value --}}
                    <div class="form-group2">
                        <input id="name" class="form-control" name="name" type="text" value="test">

                    </div> 
               </div> 
               <div class="form-group">
                    {{BF::label('email','Email')}}
                    {{--this is how we pass the $post->property as a default value --}}
                    <div class="form-group2">
                        <input id="email" class="form-control" name="email" type="text" value="test@gmail.com">
                    </div>
               </div> 
                 <div class="form-group">
                    {{BF::label('avatar','Avatar')}}
                    <div class="form-group2">
                        <input id="avatar" name="avatar" type="file">
                    </div> 
                    {{-- hidden file for the image --}}
                    {{-- this is the hidden file --}}
                    {{BF::hidden("imagename", $user->avatar)}}
               </div>  
                  <div class="form-group2">
                    <p>You can change these settings at any time.</p>   
                    <div class="form-edit-meta">
                      
                        {{ BF::submit('Edit User', '')}}

                    </div>
                </div>
                {{BF::hidden("_method", "PUT")}}

            {!! BF::close() !!}

                               
                      
    </section>
    {{-- this is the way we delete the post
        use the destroy function of the controller
        and pass the ID, just like the update,
        that way laravel knows what to delete
     --}}
       {!! BF::open(["action" => ["UserController@destroy", $user->id], "method" => "POST", "class" => "delete"]) !!}
                {{BF::hidden("_method","DELETE")}}
                {{BF::submit('Delete User', '')}}
            {!!BF::close() !!}   
@endsection
