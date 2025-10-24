<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationResource\Pages;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Resource;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'Contenuti';
    protected static ?int $navigationSort = 5;

    protected static ?string $modelLabel = 'Location';
    protected static ?string $pluralModelLabel = 'Location';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Dettagli location')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nome')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('city')
                        ->label('Città')
                        ->maxLength(255)
                        ->nullable(),

                    Forms\Components\TextInput::make('latitude')
                        ->label('Latitudine')
                        ->numeric()
                        ->nullable(),

                    Forms\Components\TextInput::make('longitude')
                        ->label('Longitudine')
                        ->numeric()
                        ->nullable(),

                    Forms\Components\Textarea::make('description')
                        ->label('Descrizione')
                        ->rows(3)
                        ->nullable(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->withCount('trackSpots', 'events'))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('city')
                    ->label('Città')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('track_spots_count')
                    ->label('Track spot')
                    ->sortable(),

                Tables\Columns\TextColumn::make('events_count')
                    ->label('Eventi')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('has_events')
                    ->label('Solo con eventi')
                    ->query(fn(Builder $q) => $q->has('events')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            LocationResource\RelationManagers\TrackSpotsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}
