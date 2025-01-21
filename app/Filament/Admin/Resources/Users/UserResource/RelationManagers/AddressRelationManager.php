<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Users\UserResource\RelationManagers;

use App\Enums\AddressType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'addresses';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('surname')
                    ->label(__('Surname'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('address_type')
                    ->label(__('Address type'))
                    ->required()
                    ->options(AddressType::class),
                Forms\Components\TextInput::make('financial_number')
                    ->label(__('Financial Number') . '(optional)')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label(__('Phone'))
                    ->integer()
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('address')
            ->columns([
                Tables\Columns\TextColumn::make('address')->label(__('Address')),
                Tables\Columns\TextColumn::make('city')->label(__('City')),
                Tables\Columns\TextColumn::make('zip_code')->label(__('Zip code')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
