<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 20px">
    @if(session('user_id'))
        <a class="navbar-brand" href="{{route('blogs.index')}}">Blogs APP</a>
    @endif
    <div class="collapse navbar-collapse" id="navbarNav">
        @if(session('user_id'))
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('blogs.index')}}">Blogs<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        @endif
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @if(!session('user_id'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @else
                <li class="nav-item" >
                    <a class=" btn btn-danger " href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</nav>
