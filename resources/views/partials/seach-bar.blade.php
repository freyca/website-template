<!-- resources/views/partials/search-bar.blade.php -->
<form class="form-inline my-2 my-lg-0" action="{{ route('search') }}" method="GET">
  <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" name="query">
  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
</form>
