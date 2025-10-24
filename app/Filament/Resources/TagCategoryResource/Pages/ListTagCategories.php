<?php

namespace App\Filament\Resources\TagCategoryResource\Pages;

use App\Filament\Resources\TagCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTagCategories extends ListRecords
{
    protected static string $resource = TagCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
