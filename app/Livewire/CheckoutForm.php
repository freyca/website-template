<?php

namespace App\Livewire;

use App\Enums\PaymentMethod;
use App\Models\User;
use App\Models\UserMetadata;
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
use Livewire\Attributes\On;

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
        $user = auth()->user();

        $form = match ($user) {
            null => $this->getFormForNotLoggedInUser($form),
            default => $this->getFormForLoggedInUser($user, $form),
        };

        return $form->statePath('checkoutFormData');
    }

    public function create(): void
    {
        dd($this->form->getState());
    }

    #[On('refresh-cart')]
    public function render(): View
    {
        return view('livewire.checkout-form');
    }

    private function getFormForLoggedInUser(User $user, Form $form): Form
    {
        $shipping_addresses = UserMetadata::where('user_id', $user->id)->pluck('address', 'id');
        $shipping_addresses->put(0, __('New address'));

        return $form
            ->schema([
                $this->getShippingForm($shipping_addresses),
                $this->getBillingForm($shipping_addresses),
                $this->getOrderDetails(),
                $this->getPaymentDetails(),
            ]);
    }

    private function getFormForNotLoggedInUser(Form $form): Form
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
                $this->addressFormFields('shipping', $shipping_addresses === [])
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
                ->required(),
            TextInput::make($form_field_name . '_surname')
                ->placeholder(__('Surname'))
                ->hiddenLabel()
                ->prefixIcon('heroicon-c-user-group')
                ->required(),
            TextInput::make($form_field_name . '_cif')
                ->placeholder(__('NIF/CIF'))
                ->hiddenLabel()
                ->numeric()
                ->prefixIcon('heroicon-s-identification')
                ->required(),
            TextInput::make($form_field_name . '_phone')
                ->placeholder(__('Phone'))
                ->hiddenLabel()
                ->prefixIcon('heroicon-s-phone')
                ->numeric()
                ->required(),
            TextInput::make($form_field_name . '_address')
                ->placeholder(__('Address'))
                ->hiddenLabel()
                ->prefixIcon('heroicon-s-truck')
                ->required(),
            TextInput::make($form_field_name . '_city')
                ->placeholder(__('City'))
                ->hiddenLabel()
                ->prefixIcon('heroicon-s-building-office-2')
                ->required(),
            TextInput::make($form_field_name . '_state')
                ->placeholder(__('State'))
                ->hiddenLabel()
                ->prefixIcon('heroicon-s-globe-alt')
                ->required(),
            TextInput::make($form_field_name . '_zip_code')
                ->placeholder(__('Zip code'))
                ->numeric()
                ->hiddenLabel()
                ->prefixIcon('heroicon-m-hashtag')
                ->required(),
            TextInput::make($form_field_name . '_country')
                ->placeholder(__('Country'))
                ->hiddenLabel()
                ->prefixIcon('heroicon-s-globe-europe-africa')
                ->required(),
            Checkbox::make('purchase_as_guest')
                ->live()
                ->default(false)
                ->label(__('Purchase as guest'))
                ->hidden(function () use ($form_field_name, $is_guest) {
                    // Hidden on billing and for registered users
                    return $form_field_name === 'billing' || $is_guest === false;
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
