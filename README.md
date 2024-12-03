# Requirements
 - php8.2+
 - node20
 - npm10

# Deploy
 - composer install
 - npm install
 - npm run build
 - cp .env.example .env
 - php artisan key:generate
 - php artisan storage:link
 - Ensure dirs exists
   - public/storage/product-images
   - public/storage/category-images

# TODO:
 - mustverifyemail para usuarios: https://laravel.com/docs/11.x/verification#model-preparation
 - make meta-description a variable in head
 - show reduced prices 'price_when_user_owns_product' to users
 - keep filter sidebar if is open (must convert open/close button to livewire)
 - filter correctly complements and spare parts by features

 ## Metodos de pago
 - sequra para financiación
 - tarjeta
 - paypal
 - bizum
 - transferencia bancaria

 ## Metodos de envio
 - Directamente a través do proveedor: url + numero seguimiento

 ## Landings
 - complementos/recambios a un precio rebajado si compras maquina

 ## Buscador
 - no busca en productos con variantes

