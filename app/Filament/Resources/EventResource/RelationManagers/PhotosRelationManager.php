<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use App\Models\Photo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;

class PhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'photos'; // relazione nel modello Event

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titolo')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Descrizione')
                    ->columnSpanFull(),

                Forms\Components\DateTimePicker::make('taken_at')
                    ->label('Data Scatto'),

                Forms\Components\Toggle::make('published')
                    ->label('Pubblicata')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Titolo')->searchable(),
                Tables\Columns\TextColumn::make('taken_at')->label('Data')->dateTime(),
                Tables\Columns\IconColumn::make('published')->boolean()->label('Pubblicata'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
