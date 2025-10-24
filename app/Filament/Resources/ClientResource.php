<?php

namespace App\Filament\Resources;

use App\Models\Client;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers\RequestsRelationManager;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Clienti e Richieste';
    protected static ?string $label = 'Cliente';
    protected static ?string $pluralLabel = 'Clienti';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nome')
                ->required(),
            Forms\Components\TextInput::make('email')
                ->email()
                ->label('Email')
                ->required(),
            Forms\Components\Textarea::make('notes')->label('Note'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Nome')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('requests_count')
                    ->counts('requests')
                    ->label('Richieste'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creato il')
                    ->dateTime('d/m/Y'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Vedi'),
                Tables\Actions\EditAction::make()->label('Modifica'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // RequestsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
            'view' => Pages\ViewClient::route('/{record}'),
        ];
    }
}
