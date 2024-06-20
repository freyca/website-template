<!-- resources/views/components/product-grid.blade.php -->
<div class="container mt-5">
  <div class="row">
    @foreach($products as $product)
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card">
          <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
          <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ $product->description }}</p>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#productModal{{ $product->id }}">Ver detalles</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
