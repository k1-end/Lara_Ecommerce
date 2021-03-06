<header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="{{route('home')}}" class="nav-link px-2 {{(Request::is('/'))? "text-secondary" : "text-white"}}">Home</a></li>
          @if(auth()->check() && auth()->user()->getRoleNames()->contains('admin'))
          <li><a href="{{url('/dashboard')}}" class="nav-link px-2 {{(Request::is('dashboard/*'))? "text-secondary" : "text-white"}}">Dashboard</a></li>
          @endif
          <li><a href="#" class="nav-link px-2 {{(Request::is('about'))? "text-secondary" : "text-white"}}">About</a></li>
        </ul>

        <form id="search" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="/search" method="GET">
          @csrf
          <input name="query" id="query" type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>
        @if(!auth()->check())
        <div class="text-end">
          <a href="{{route('login')}}" type="button" class="btn btn-outline-light me-2">Login</a>
          <a href="{{route('signup')}}" class="btn btn-warning">Sign-up</a>
        </div>
        @endif
        @auth
        @if (! auth()->user()->getRoleNames()->contains('admin'))
        <div class="text-end">
          <a href="{{route('cart')}}" class="btn btn-warning  me-2">Cart({{\App\Models\Cart::where('user_id' , auth()->id())->count()}})</a>
        </div>    
        @endif
        <div class="text-end">
          <a href="{{route('logout')}}" class="btn btn-warning  me-2">Logout</a>
        </div>
        @endauth
      </div>
    </div>
  </header>
  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif