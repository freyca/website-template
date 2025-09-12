<?php

namespace App\Filament\Admin\Resources\Products;

use App\Filament\Admin\Resources\Products\DisassemblyResource\Pages;
use App\Filament\Admin\Resources\Products\Traits\FormBuilderTrait as TraitsFormBuilderTrait;
use App\Models\Disassembly;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DisassemblyResource extends Resource
{
    use TraitsFormBuilderTrait;

    protected static ?string $model = Disassembly::class;

    protected static ?string $navigationIcon = 'heroicon-s-wrench-screwdriver';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->label(__('Name'))
                        ->required()
                        ->maxLength(255),
                ]),

                Forms\Components\Section::make(__('Product'))->schema([
                    Forms\Components\Select::make('product_id')
                        ->label(__('Product'))
                        ->required()
                        ->relationship(name: 'product', titleAttribute: 'name')
                        ->columnSpanFull()
                        ->searchable()
                        ->preload(),
                ]),

                self::imagesSection(),

                Forms\Components\Section::make(__('Spare parts'))->schema([
                    Forms\Components\Repeater::make('productSpareParts')
                        ->label(__('Product spare parts'))
                        ->relationship()
                        ->schema([
                            self::mainSection(),

                            self::priceSectionWithParentProduct(),
                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('main_image')
                    ->circular()
                    ->label(__('Image')),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListDisassemblies::route('/'),
            'edit' => Pages\EditDisassembly::route('/{record}/edit'),
            'create' => Pages\CreateDisassembly::route('/create'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('Disassembly');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Products');
    }
}
