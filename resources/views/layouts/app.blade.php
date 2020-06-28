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
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">

        <!-- Styles -->
      
    </head>
    <body>
  
        <div class="container">  
        <!--to avoid reusing code create a layout which will be the base of your HTML -->
         
            
        <header>
            <!-- this are just some includes like messages and the navigation "bar"-->
        @include("includes.nav")
        @include("includes.messages")
        
        </header>
        
        <main>
      
            <!-- this is the content we are loading -->
            <!-- names must match -->
            @yield("content")
        </main>  
           <footer>
            <p>My Recipes Book made by aldocaava.</p>
        </footer>
        </div>
     
    
    </body>
</html>
