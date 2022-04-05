<header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
          <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
          <li><a href="#" class="nav-link px-2 text-white">About</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>
        @if(!auth()->check())
        <div class="text-end">
          <a href="{{route('login')}}" type="button" class="btn btn-outline-light me-2">Login</a>
          <a href="{{route('signup')}}" class="btn btn-warning">Sign-up</a>
        </div>
        @endif
        @auth
        <div class="text-end">
          <a href="{{route('cart')}}" class="btn btn-warning  me-2">Cart({{\App\Models\Cart::where('user_id' , auth()->id())->count()}})</a>
        </div>
        <div class="text-end">
          <a href="#" class="btn btn-warning  me-2">Logout</a>
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