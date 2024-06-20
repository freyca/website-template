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
  - Modals with: https://github.com/wire-elements/modal

 # Producto:
   - titulo
   - slogan
   - caracteristicas
     - uso
     - motor
   - imagenes e videos
   - accesorios, complementos da maquina
   - recambios, elementos de desgaste, deben ter descontos se compras o producto. Os descontos deben ser pra sempre
   - caracteristicas: https://www.agrieuro.es/motoazada-agrieuro-premium-line-agri-102-motor-de-gasolina-honda-gx-270-p-10600.html
   - descripcion das caracteristicas
   - productos relacionados
   - apartado con productos gratuitos

  # Metodos de pago
  - sequra para financiación
  - tarjeta
  - paypal
  - bizum
  - transferencia bancaria

  # Metodos de envio
  - Directamente a través do proveedor: url + numero seguimiento

  # Landings
  - complementos/recambios a un precio rebajado si compras maquina

  # Categorias (custom queries para custom url)
   - Motoazadas gasolina menos de 1000€

  # Paginas
   - paginas de complementos
   - paginas de recambios

  # Buscador

  # Personalizacion de producto
   - product-features como tabla a traves de tabla pivote, porque se comparten caracteristicas

 # Traducciones: https://github.com/filamentphp/spatie-laravel-translatable-plugin