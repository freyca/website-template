<?php

declare(strict_types=1);

namespace App\Filament\User\Resources;

use App\Enums\AddressType;
use App\Filament\User\Resources\AddressResource\Pages;
use App\Models\Address;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        $user = Auth::user();

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name'))
                    ->required()
                    ->default($user->name)
                    ->maxLength(255),
                Forms\Components\TextInput::make('surname')
                    ->label(__('Surname'))
                    ->default($user->surname)
                    ->required()
                    ->maxLength(255),
                Forms\Components\ToggleButtons::make('address_type')
                    ->label(__('Address type'))
                    ->default(AddressType::Shipping)
                    ->inline()
                    ->required()
                    ->options(AddressType::class),
                Forms\Components\TextInput::make('bussiness_name')
                    ->label(__('Business Name').'(optional)')
                    ->maxLength(255),
                Forms\Components\TextInput::make('financial_number')
                    ->label(__('Financial Number').'(optional)')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label(__('Phone'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->label(__('Address'))
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('city')
                    ->label(__('City'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('state')
                    ->label(__('State'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('zip_code')
                    ->label(__('Zip code'))
                    ->required()
                    ->numeric()
                    ->integer()
                    ->maxLength(255),
                Forms\Components\TextInput::make('country')
                    ->label(__('Country'))
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('address')
                    ->label(__('Address')),
                Tables\Columns\TextColumn::make('address_type')
                    ->label(__('Type'))
                    ->badge(),
                Tables\Columns\TextColumn::make('city')
                    ->label(__('City')),
                Tables\Columns\TextColumn::make('zip_code')
                    ->label(__('Zip code')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'create' => Pages\CreateAddress::route('/create'),
            'index' => Pages\ListAddress::route('/'),
            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('User');
    }

    public static function getModelLabel(): string
    {
        return __('Shipping address');
    }
}
