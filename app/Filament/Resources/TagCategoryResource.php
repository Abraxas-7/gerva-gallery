<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagCategoryResource\Pages;
use App\Filament\Resources\TagCategoryResource\RelationManagers\TagsRelationManager;
use App\Models\TagCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;

class TagCategoryResource extends Resource
{
    protected static ?string $model = TagCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Classificazioni';
    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Categoria Tag';
    protected static ?string $pluralModelLabel = 'Categorie Tag';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nome categoria')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->label('Descrizione')
                ->rows(3)
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\TagCategory::query()->withCount('tags'))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('tags_count')
                    ->label('Tag associati')
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Descrizione')
                    ->limit(40),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TagsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTagCategories::route('/'),
            'create' => Pages\CreateTagCategory::route('/create'),
            'edit' => Pages\EditTagCategory::route('/{record}/edit'),
        ];
    }
}
