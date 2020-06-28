<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostsController extends Controller
{
    public function __construct()
    {
         
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {   //display all the posts(recipes)
        //we display all the posts fot the model Post
        //$posts = Post::where('email','=',$user -> email) ->orderBy('created_at','description') ->paginate(6);
        //return a view inside ythe posts folder ie index
        //with() to pass the data we want
        //name for access
      //  return view("posts.index")->with('posts',$posts);
      $posts = Post::all();
      return view("posts.index",compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts.create");
    }
 //  public function search(Request $request)
//    {
       // $input = $request->input();
 //       $search =$request->get('search');
 //       $posts = DB::table('posts')->where ('title','like','%'.$search.'%')
 //                                   ->orWhere('ingredients','like','%'.$search.'%')
  //                                  ->paginate(5);
 //       return view('index',['posts' =>$posts]);
 //   }

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get the request
        //and validate the fields
        // now this is the function that stores the data in the database table

        //first we validate the incoming request
        $this->validate(
            //the names match the input names of the form
            //then we say if it can be null or required
            $request, [
                'title' => 'required',
                'preptime' => 'required',
                'image' => 'required|image|max:1999', //this is for the image, "image" means it MUST be an image file
                'description' => 'required',
                'ingredients' => 'required',
                'preparation' => 'required'
            ]
        );
        //"handle image upload
        //get the file name
        //this is the $request file we got from the POST
        $fullFilename = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($fullFilename, PATHINFO_FILENAME);
        $fileExt = $request->file('image')->getClientOriginalExtension();

        //----  get the file ready to be stored
         
        $renamedFile =  $filename . "_" . time() . "." . $fileExt;

        //---- path where the uploaded image will be stored in the app
        $path = $request->file('image')->storeAs("public/covers", $renamedFile);

     
        $post = new Post;
      
        $post->title = $request->input('title');
        $post->preptime = $request->input('preptime');
       
        $post->cover = $renamedFile; 
        $post->description = $request->input('description');
        $post->ingredients = $request->input('ingredients');
        $post->preparation = $request->input('preparation');

        $post->user_id = Auth::id();
        
        //--- save the post
        $post->save();   

        //-----redirect
        return redirect("/posts")->with("success", "Post Created!");



    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //find the current post using the id
        //the show functions shows the file information
        $post= Post::find($id); //get the post using the ID
        return view("posts.show")->with('post', $post); //return a view with the post data  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect("/")->with('error', "You are not authorized to perform that action");
        }else{
            return view("posts.edit")->with('post', $post);

            //returning a filled form with the previous input. 
            //In forms: redirect back() withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //update the post information

        //works similar to the store function
        //we get the data
        // and do the rename for the image if there is any
        //get the request
        //and validate the fields
        $this->validate(
            $request, [
                'title' => 'required',
                'preptime' => 'required',
                'image' => 'nullable|image|max:1999', //set the image as optional
                'description' => 'required',
                'ingredients' => 'required',
                'preparation' => 'required'
            ]
        );

        //------- we need to check if there is a new image in the set
        //if the image file comes without a value
        if( empty($request->file('image'))){

            //we just set the value of a hidden file
            //which returns the current image name
            //so laravel sets that name again
            //else it will set it to "" empty string

            //we get the value of the hidden imagename input
            //and set it to the variable that we will store in the database
            //in this case it will be the same as the one before
            $newFile = $request->input('imagename');
        }else{
            //------- handle the image upload
            //------- if theres an image we rename it

            //get the file name
            $fullFilename = $request->file('image')->getClientOriginalName();
            //get the just the name
            $filename = pathinfo($fullFilename, PATHINFO_FILENAME);
            //get the extension
            $fileExt = $request->file('image')->getClientOriginalExtension();

            //get the file ready to be stored
            //adding a timestamp     
            $newFile =  $filename . "_" . time() . "." . $fileExt;

            //-------- store the image
            //prepare the path where the image is going to be saved
            //-------- to get access to the folder create a symlink, run the next code: 
            //-------- php artisan storage:link
            //-------- a new folder will appear in the public folder
            $path = $request->file('image')->storeAs("public/covers", $newFile);
            
                //------- remove the image that was before


                //get the previous name
                //we get the hidden input name 
                //remember thats the old image name
                $fileToDelete = $request->input('imagename');
                //use the default directory separator for the OS
                //and here we use unlink on the image
                $prevFile = "storage". DIRECTORY_SEPARATOR . "covers" . DIRECTORY_SEPARATOR . $fileToDelete;
                //use public_path to find the path to the file
                unlink(public_path($prevFile));

                //laravel wont delete the image even if another one is set
                //it will just add it

        }
        //dd(Auth::id());
        
        //find the post to update (recipe)
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->preptime = $request->input('preptime');
        $post->cover = $newFile; // we save the renamed file, not the original
        $post->description = $request->input('description');
        $post->ingredients = $request->input('ingredients');
        $post->preparation = $request->input('preparation');

          //save the post
        $post->save();   

        
            

          //redirect
          return redirect("/posts")->with("success", "Post Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
            
        if(auth()->user()->id !== $post->user_id){
            return redirect("/")->with('error', "You are not authorized to perform that action");
        }else{
            $fileToDelete = $post->cover;
           
            $prevFile = "storage". DIRECTORY_SEPARATOR . "covers" . DIRECTORY_SEPARATOR . $fileToDelete;
         
            unlink(public_path($prevFile));
      
        
            $post->delete();
            return redirect("/posts")->with("success", "Post Deleted!");

        }
              
      

    }
    
}
