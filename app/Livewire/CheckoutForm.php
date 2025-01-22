<?php

namespace App\Livewire;

use App\Enums\PaymentMethod;
use App\Models\User;
use App\Models\Address;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Group;
use Livewire\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use App\Services\OrderBuilder;

class CheckoutForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $checkoutFormData = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        /** @var User */
        $user = Auth::user();

        $form = match ($user) {
            null => $this->buildFormForNotLoggedInUser($form),
            default => $this->buildFormForLoggedInUser($user, $form),
        };

        return $form->statePath('checkoutFormData');
    }

    public function create(): void
    {
        $orderBuilder = new OrderBuilder($this->form->getState());
    }

    #[On('refresh-cart')]
    public function render(): View
    {
        return view('livewire.checkout-form');
    }

    private function buildFormForLoggedInUser(User $user, Form $form): Form
    {
        $shipping_addresses = Address::where('user_id', $user->id)->pluck('address', 'id');

        if ($shipping_addresses->count() !== 0) {
            $shipping_addresses->put(0, __('New address'));
        }

        return $form
            ->schema([
                $this->getShippingForm($shipping_addresses),
                $this->getBillingForm($shipping_addresses),
                $this->getOrderDetails(),
                $this->getPaymentDetails(),
            ]);
    }

    private function buildFormForNotLoggedInUser(Form $form): Form
    {
        return $form
            ->schema([
                $this->getShippingForm(),
                $this->getBillingForm(),
                $this->getOrderDetails(),
                $this->getPaymentDetails(),
            ]);
    }

    private function getShippingForm($shipping_addresses = new Collection)
    {
        return Section::make(__('Shipping Address'))
            ->icon('heroicon-s-truck')
            ->schema([
                Select::make('shipping_address_id')
                    ->hiddenLabel()
                    ->options($shipping_addresses)
                    ->selectablePlaceholder(false)
                    ->default($shipping_addresses->keys()->first())
                    ->live()
                    ->hidden(function () use ($shipping_addresses) {
                        // If there is no addresses
                        return $shipping_addresses->count() === 0;
                    }),
                $this->addressFormFields('shipping', Auth::user() === null)
                    ->hidden(
                        function (Get $get) use ($shipping_addresses) {
                            // If there is no addresses
                            if (count($shipping_addresses) === 0) {
                                return false;
                            }

                            // If is checked 'new address
                            return $get('shipping_address_id') !== "0";
                        }
                    )
            ]);
    }

    private function getBillingForm($billing_addresses  = new Collection)
    {
        return Section::make(__('Billing Address'))
            ->icon('heroicon-s-credit-card')
            ->schema([
                Checkbox::make('use_shipping_address')
                    ->live()
                    ->default(true)
                    ->label(__('Same as shipping')),
                Select::make('billing_address_id')
                    ->hiddenLabel()
                    ->options($billing_addresses)
                    ->selectablePlaceholder(false)
                    ->default($billing_addresses->keys()->first())
                    ->live()
                    ->hidden(
                        function (Get $get) use ($billing_addresses) {
                            // If is checked use_shipping_address
                            if ($get('use_shipping_address')) {
                                return true;
                            }

                            // If there is no addresses
                            return $billing_addresses->count() === 0;
                        }
                    ),
                $this->addressFormFields('billing')
                    ->hidden(
                        function (Get $get) use ($billing_addresses) {
                            // If is checked use_shipping_address
                            if ($get('use_shipping_address')) {
                                return true;
                            }

                            // If there is no billing addresses
                            if ($billing_addresses->count() === 0) {
                                return false;
                            }

                            // If is checked "New address
                            return $get('billing_address_id') !== "0";
                        }
                    )
            ]);
    }

    private function addressFormFields(string $form_field_name, bool $is_guest = true)
    {
        return Group::make([
            TextInput::make($form_field_name . '_name')
                ->placeholder(__('Name'))
                ->hiddenLabel()
                ->prefixIcon('heroicon-s-user')
                ->maxLength(255)
                ->required(),
            TextInput::make($form_field_name . '_surname')
                ->placeholder(__('Surname'))
                ->hiddenLabel()
                ->maxLength(255)
                ->prefixIcon('heroicon-c-user-group')
                ->required(),
            TextInput::make($form_field_name . '_email')
                ->placeholder(__('Email'))
                ->hiddenLabel()
                ->maxLength(20)
                ->email()
                ->prefixIcon('heroicon-c-user-group')
                ->required()
                ->hidden(function () use ($form_field_name, $is_guest) {
                    // Hidden on billing
                    if ($form_field_name === 'billing') {
                        return true;
                    }

                    // Hidden if user is registered
                    return $is_guest === false;
                }),
            TextInput::make($form_field_name . '_cif')
                ->placeholder(__('NIF/CIF') . ' (' . __('optional') . ')')
                ->hiddenLabel()
                ->maxLength(20)
                ->prefixIcon('heroicon-s-identification'),
            TextInput::make($form_field_name . '_phone')
                ->placeholder(__('Phone'))
                ->hiddenLabel()
                ->prefixIcon('heroicon-s-phone')
                ->numeric()
                ->maxLength(20)
                ->tel()
                ->required(),
            TextInput::make($form_field_name . '_address')
                ->placeholder(__('Address'))
                ->hiddenLabel()
                ->prefixIcon('heroicon-s-truck')
                ->maxLength(255)
                ->required(),
            TextInput::make($form_field_name . '_city')
                ->placeholder(__('City'))
                ->hiddenLabel()
                ->prefixIcon('heroicon-s-building-office-2')
                ->maxLength(255)
                ->required(),
            TextInput::make($form_field_name . '_state')
                ->placeholder(__('State'))
                ->hiddenLabel()
                ->prefixIcon('heroicon-s-globe-alt')
                ->maxLength(255)
                ->required(),
            TextInput::make($form_field_name . '_zip_code')
                ->placeholder(__('Zip code'))
                ->numeric()
                ->hiddenLabel()
                ->prefixIcon('heroicon-m-hashtag')
                ->maxLength(20)
                ->required(),
            TextInput::make($form_field_name . '_country')
                ->placeholder(__('Country'))
                ->hiddenLabel()
                ->prefixIcon('heroicon-s-globe-europe-africa')
                ->maxLength(255)
                ->required(),
            Checkbox::make('purchase_as_guest')
                ->live()
                ->default(false)
                ->label(__('Purchase as guest'))
                ->hidden(function () use ($form_field_name, $is_guest) {
                    // Hidden on billing
                    if ($form_field_name === 'billing') {
                        return true;
                    }

                    // Hidden if user is registered
                    return $is_guest === false;
                })
        ]);
    }

    private function getOrderDetails()
    {
        return Section::make(__('Order details'))
            ->schema([
                Textarea::make('order_details')
                    ->hiddenLabel()
                    ->placeholder(__('If you have any special requirement, let us know')),
            ]);
    }

    private function getPaymentDetails()
    {
        return Section::make(__('Payment method'))
            ->schema([
                ToggleButtons::make('payment_method')
                    ->hiddenLabel()
                    ->options(PaymentMethod::class)
                    ->inline()
                    ->required()
                    ->default(PaymentMethod::Card)
            ]);
    }
}
