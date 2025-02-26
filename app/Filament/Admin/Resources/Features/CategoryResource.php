<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Features;

use App\Filament\Admin\Resources\Features\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('name')
                        ->label(__('Name'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('slug')
                        ->disabled(),
                    Forms\Components\TextInput::make('meta_description')
                        ->label(__('Meta description'))
                        ->required()
                        ->maxLength(255),
                    TiptapEditor::make('description')
                        ->label(__('Description'))
                        ->required()
                        ->columnSpanFull(),
                ])->columns(2),

                Forms\Components\FileUpload::make('big_image')
                    ->label(__('Big image'))
                    ->required()
                    ->moveFiles()
                    ->preserveFilenames()
                    ->orientImagesFromExif(false)
                    ->directory(config('custom.category-image-storage')),
                Forms\Components\FileUpload::make('small_image')
                    ->label(__('Small image'))
                    ->required()
                    ->moveFiles()
                    ->preserveFilenames()
                    ->orientImagesFromExif(false)
                    ->directory('category-images'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('small_image')
                    ->circular()
                    ->label(__('Image')),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Features');
    }

    public static function getModelLabel(): string
    {
        return __('Categories');
    }
}
