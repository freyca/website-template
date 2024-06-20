
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img class="transparent-logo light-scheme-logo" src="https://roteco.es/wp-content/uploads/2020/12/roteco-logo-web.png" alt="Roteco"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          @foreach (config('custom.nav-sections') as $section => $url)
                      <li class="nav-item">
                      <a class="nav-link " href="{{ $url }}">{{ ucfirst($section) }}</a>
                      </li>
                    @endforeach
          
        </ul>
      
      </div>
    </div>
  </nav>