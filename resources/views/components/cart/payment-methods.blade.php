<div id="paymentMethod" class="rounded-lg border bg-white p-2 shadow-sm px-6 py-4">
    <p class="py-2 text-xl font-semibold text-gray-900 ">
        {{ __('Payment method') }}
    </p>

    <ul class="mt-2 space-y-3">
    @foreach (App\Enums\PaymentMethod::cases() as $paymentMethod)
        <li style="list-none list-outside">
            <label for="{{$paymentMethod->name}}" class="block relative">
                <input
                    type="radio"
                    id="{{ $paymentMethod->name }}"
                    name="paymentMethod"
                    value="{{ $paymentMethod->value }}"
                    @if ($loop->first) {{ 'checked' }} @endif
                    class="sr-only peer"
                >
                <div class="w-full flex gap-x-3 items-start p-4 cursor-pointer rounded-lg border bg-white shadow-sm ring-primary-600 peer-checked:ring-2 duration-200">
                    <div class="flex-none">
                        <div>@svg($paymentMethod->getIcon(), 'w-6 h-6 mx-2')</div>
                    </div>
                    <div>
                        <h3 class="leading-none text-gray-800 font-medium pr-3">
                            {{ __("$paymentMethod->value") }}
                        </h3>
                    </div>
                </div>

                <div class="absolute top-5 right-5 flex-none flex items-center justify-center w-4 h-4 rounded-full border peer-checked:bg-primary-600 text-white peer-checked:text-white duration-200">
                </div>
            </label>
        </li>
    @endforeach
    </ul>
</div>