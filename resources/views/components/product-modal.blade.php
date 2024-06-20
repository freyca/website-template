<!-- resources/views/components/product-modal.blade.php -->
@foreach($products as $product)
<div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel{{ $product->id }}">{{ $product->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <img src="{{ $product->image_url }}" class="img-fluid" alt="{{ $product->name }}">
            </div>
            <div class="col-md-6">
              <p>{{ $product->description }}</p>
              <p>Precio: ${{ $product->price }}</p>
              <button class="btn btn-primary">Añadir al carrito</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
