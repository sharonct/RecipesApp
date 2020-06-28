
@extends("layouts.app")
@section("content")
  
    <section>
           <h2>New Recipe</h2>
           
            {!! BF::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' , 'files' => true]) !!}
               <div class="form-group">
                    {{BF::label('title','Title')}}
                    <div  class="form-group2">
                         <input placeholder="This is the recipe name" id="title" name="title" >
                    </div>
               </div> 
               <div class="form-group">
                    {{BF::label('preptime','Preptime')}}
                    <div  class="form-group2">
                         <input placeholder="The time it would take for the whole recipe to be completed, doesnt have to be exact"id="preptime" name="preptime"  >
                    </div>
               </div> 
               <div class="form-group">
                    {{BF::label('image','Image')}}
                    <div  class="form-group2">
                         <input class="form-control" id="image" name="image" type="file">
                    </div>
               </div> 
                 <div class="form-group">
                    {{BF::label('description','Description')}}
                    <div class="form-group2">
                         <textarea placeholder="Describe the recipe, give a little overview of what to expect "id="description" name="description"  ></textarea>
                    </div>
               </div> 
               <div class="form-group">
                    {{BF::label('ingredients','Ingredients')}}
                    <div  class="form-group2">
                    <textarea placeholder="The ingredients needed for the recipe, separate them with commas"id="ingredients" name="ingredients" ></textarea>
                    </div>
               </div> 
               <div class="form-group">
                    {{BF::label('preparation','Preparation')}}
                    <div  class="form-group2">
                         <textarea placeholder="The detailed recipe preparation process" id="preparation" name="preparation" ></textarea>
                    </div>
               </div> 
               <div class="form-group2">
                <p>Proofread your recipe, make sure the information is clear and there are no missing ingredients</p>   
                    {{BF::submit('Add Recipe', '')}}
                </div>
            {!! BF::close() !!}

    </section>
@endsection


