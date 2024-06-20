<?php

declare(strict_types=1);

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\UserMetadataResource\Pages;
use App\Models\UserMetadata;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserMetadataResource extends Resource
{
    protected static ?string $model = UserMetadata::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('address')
                    ->label(__('Address'))
                    ->required(),
                Forms\Components\TextInput::make('city')
                    ->label(__('City'))
                    ->required(),
                Forms\Components\TextInput::make('postal_code')
                    ->label(__('Postal code'))
                    ->numeric()
                    ->integer()
                    ->required(),

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('address')
                    ->label(__('Address')),
                Tables\Columns\TextColumn::make('city')
                    ->label(__('City')),
                Tables\Columns\TextColumn::make('postal_code')
                    ->label(__('Postal code')),
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
            'create' => Pages\CreateUserMetadata::route('/create'),
            'index' => Pages\ListUserMetadata::route('/'),
            'edit' => Pages\EditUserMetadata::route('/{record}/edit'),
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
