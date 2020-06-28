<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- this is my original file -->
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>What2Cook</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->
        <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/main.css')}}"
        <!-- Styles --> 
      
    </head>
    <body>
  
        <div class="container">  
            
        <header>
            <!-- this are just some includes like messages and the navigation "bar"-->
        @include("includes.nav")
        @include("includes.messages")
        <h1>What2Cook</h1>
          
        </header>
        
        <main>
            <div class="row">
                <div class="col-md-6">
                    <h2>Search</h2>
                </div>
            <div class="col-md-4">
                <form action="/search" method="get">
                    <div class ="input-group">
                        <input type='search' name="search" class="form-control">
                        <span class="input-group-prepend">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </span>
                    </div>
                </form>
            </div>
          
        </main>  
           <footer>
            <p>Search for any recipe of your choice by just inputting your ingredients or the name of the food in the search box above.</p>
        </footer>
        </div>
     
    </body>
</html>
