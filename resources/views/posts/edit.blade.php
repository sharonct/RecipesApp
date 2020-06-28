
@extends("layouts.app")
@section("content")
  
    <section>
           <h2>New Recipe</h2>
           
          {!! BF::open(['action' => ['PostsController@update',$post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data' , 'files' => true]) !!}
               <div class="form-group">
                    {{BF::label('title','Title')}}
                    <div  class="form-group2">
                         <input value="{{$post->title}}" id="title" name="title" >
                    </div>
               </div> 
               <div class="form-group">
                    {{BF::label('preptime','Preptime')}}
                    <div  class="form-group2">
                         <input value="{{$post->preptime}}"id="preptime" name="preptime"  >
                    </div>
               </div> 
               <div class="form-group">
                    {{BF::label('image','Image')}}
                    <div  class="form-group2">
                         <input class="form-control" id="image" name="image" type="file">
                    </div>
                    <div  class="form-group2">
                         <input class="form-control" value="{{$post->cover}}" id="imagename" name="imagename" type="hidden">
                    </div>
               </div> 
                 <div class="form-group">
                    {{BF::label('description','Description')}}
                    <div class="form-group2">
                         <textarea id="description" name="description"  >{{$post->description}}</textarea>
                    </div>
               </div> 
               <div class="form-group">
                    {{BF::label('ingredients','Ingredients')}}
                    <div  class="form-group2">
                    <textarea id="ingredients" name="ingredients" >{{$post->ingredients}}</textarea>
                    </div>
               </div> 
               <div class="form-group">
                    {{BF::label('preparation','Preparation')}}
                    <div  class="form-group2">
                         <textarea id="preparation" name="preparation" >{{$post->preparation}}</textarea>
                    </div>
               </div> 
               <div class="form-group2">
                <p>Proofread your recipe, make sure the information is clear and there are no missing ingredients</p>   
                    {{BF::submit('Edit Recipe', '')}}
                </div>

               <input type="hidden" name="_method" value="PUT">
          {!! BF::close() !!}

    </section>
    @if (!Auth::guest())
               @if (Auth::user()->id == $post->user_id)
                 {!! BF::open(["action" => ["PostsController@destroy", $post->id], "method" => "POST", "class" => "delete"]) !!}
                {{BF::hidden("_method","DELETE")}}
                {{BF::submit('Delete This Post', '')}}
            {!! BF::close() !!}   
               @endif 
            @endif
@endsection


