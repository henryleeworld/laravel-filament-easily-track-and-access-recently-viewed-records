<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Imports\CategoryImporter;
use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCategories extends ManageRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ImportAction::make()
                ->label(__('Import categories'))
                ->importer(CategoryImporter::class),
            Actions\CreateAction::make(),
        ];
    }
}