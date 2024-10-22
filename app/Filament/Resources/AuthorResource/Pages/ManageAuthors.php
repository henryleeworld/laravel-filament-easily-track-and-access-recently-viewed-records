<?php

namespace App\Filament\Resources\AuthorResource\Pages;

use App\Filament\Exports\AuthorExporter;
use App\Filament\Resources\AuthorResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAuthors extends ManageRecords
{
    protected static string $resource = AuthorResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ExportAction::make()
                ->label(__('Export authors'))
                ->exporter(AuthorExporter::class),
            Actions\CreateAction::make(),
        ];
    }
}
