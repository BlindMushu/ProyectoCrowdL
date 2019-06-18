<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{route('admin.auth.login')}}">
    @if(Auth::user())
        @if(Auth::user()->type === 'admin')
        Administrador
        @else
        Miembro
        @endif
    @else
        Login
    @endif
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="#navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">

    @if(Auth::user())
        @if(Auth::user()->type === 'admin')
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active"><a class="nav-link" href="{{ route('admin.welcome')}}">Inicio</a></li>
      <li class="nav-item active"><a class="nav-link" href="{{ route('users.index')}}">Usuarios</a></li>
      <li class="nav-item active"><a class="nav-link" href="{{ route('categories.index')}}">Categorias</a></li>
      <li class="nav-item active"><a class="nav-link" href="{{ route('tags.index')}}">Tags</a></li>
      <li class="nav-item active"><a class="nav-link" href="{{ route('articles.index')}}">Articulos</a></li>

      <li class="nav-item active"><a class="nav-link" href="{{ route('images.index')}}">Imagenes</a></li>
      </ul>
      <ul class = "nav navbar-nav navbar-right">
        <li><a href="{{route('home.index')}}" target ="_blank"></a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         {{Auth::user()->name}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{route('admin.auth.logout')}}">Salir</a>

      </li>
    </ul>
        @else
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active"><a class="nav-link" href="{{ route('admin.welcome')}}">Inicio</a></li>
      <li class="nav-item active"><a class="nav-link" href="{{ route('invests.index')}}">Inversiones</a></li>
      <li class="nav-item active"><a class="nav-link" href="{{ route('articles.index')}}">Mis proyectos</a></li>

      <li class="nav-item active"><a class="nav-link" href="{{ route('trades.index')}}">Trading</a></li>
      </ul>
      <ul class = "nav navbar-nav navbar-right">
        <li><a href="{{route('home.index')}}" target ="_blank"></a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         {{Auth::user()->name}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{route('admin.auth.logout')}}">Salir</a>

      </li>
    </ul>
        @endif
    @else

    @endif

  </div>
</nav>