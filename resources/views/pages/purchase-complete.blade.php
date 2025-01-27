<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Pedido completado">

    @dump($order->payment_method)

    @if($order->payment_method === \App\Enums\PaymentMethod::BankTransfer)
        <p>Recibirás un correo electrónico con la información necesaria para realizar el pago</p>
    @endif

    @if($order->status === \App\Enums\OrderStatus::PaymentFailed)
        <p>Algo ha fallado con tu pedido</p>
        <p>Nos pondremos en contacto contigo para solucionarlo</p>
    @else
        <p>Tu pedido se ha completado</p>
        <p>En breves recibirás un email de confirmación</p>
    @endif

</x-layouts.app>
