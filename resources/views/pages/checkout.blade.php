<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de checkout">

    @if (isset($errors))
        @foreach ($errors->all() as $error)
            @dump($error)
        @endforeach
    @endif

    <form method="POST" action="/checkout" class="mx-auto max-w-screen-md px-4 2xl:px-0 my-4">
        @csrf {{ csrf_field() }}

        <x-cart.payment-methods />
        <x-cart.shipping-adress :adresses="$shipping_addresses" />

        <button type="submit"
            class="mt-4 inline shadow bg-primary-600 hover:bg-primary-500 active:translate-x-1 active:translate-y-1 text-white font-bold py-2 px-4 rounded">
            {{ __('Continue') }}
        </button>
    </form>
</x-layouts.app>
