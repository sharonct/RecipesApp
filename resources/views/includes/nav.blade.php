<nav>
   <ul>
   <li><a href="{{ route('posts.index') }}">Recipes</a></li>
    <li><a href="{{ route('posts.create') }}">Add Recipe</a></li>
      
        @if (Auth::guest())
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @else
            <li>
                <a href="{{ route('home') }}" class="username" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>

               
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
               
            </li>
        @endif

   </ul>   
</nav>