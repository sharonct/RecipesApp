<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // this is the user controller
        // the one I added to manage 
        //the updates of the user
        // mostly for the avatar, but lets take a look at it
        
        //we find the user from the users table

        $user= User::find($id);
        return view("user.editUser")->with('user', $user);
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
        // this is the User controller
        // we validate the data in the $_REQUEST object or $request in laravel
       
        //by default comes with only email and name
        $this->validate(
            $request, [
                'name' => 'required',
                'email' => 'required',
                'avatar' => 'nullable|image|max:1999',
                ]
        );
        
        // WAIT, this is the update function
     
        // now, we update the picture here
        // as we did with the posts
       if(empty($request->file('avatar'))){
            $newFile = $request->input('imagename');
        }else{
          

            //get the file name
            $fullFilename = $request->file('avatar')->getClientOriginalName();
            //get the just the name
            $filename = pathinfo($fullFilename, PATHINFO_FILENAME);
            //get the extension
            $fileExt = $request->file('avatar')->getClientOriginalExtension();
            //adding a timestamp     
            $newFile =  $filename . "_" . time() . "." . $fileExt;
            //saving the file
            $path = $request->file('avatar')->storeAs("public/avatars", $newFile);
                
            //check if the file exits
            $fileToDelete = $request->input('imagename'); 
            // but we store it in a folder called avatars
            $prevFile = "storage". DIRECTORY_SEPARATOR . "avatars" . DIRECTORY_SEPARATOR . $fileToDelete;
            if(file_exists($prevFile)){
                //use public_path to find the path to the file
                // and we delete the past avatar
                unlink(public_path($prevFile));
            }
       
        }
        
        
       
        // pass the user data
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->avatar = $newFile; 
    
        $user->save();
        return redirect("home")->with("success", "User Updated!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // I will upload the code to github,
        //try to delete the user here if you want
        // you need to delete the user
        // aaaannnd the image
    }
}
