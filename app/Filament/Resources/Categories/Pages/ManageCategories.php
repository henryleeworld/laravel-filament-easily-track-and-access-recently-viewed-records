<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Imports\CategoryImporter;
use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCategories extends ManageRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getActions(): array
    {
        return [
            ImportAction::make()
                ->label(__('Import categories'))
                ->importer(CategoryImporter::class),
            CreateAction::make(),
        ];
    }
}
