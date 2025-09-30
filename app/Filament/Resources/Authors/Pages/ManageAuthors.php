<?php

namespace App\Filament\Resources\Authors\Pages;

use App\Filament\Exports\AuthorExporter;
use App\Filament\Resources\Authors\AuthorResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ManageRecords;

class ManageAuthors extends ManageRecords
{
    protected static string $resource = AuthorResource::class;

    protected function getActions(): array
    {
        return [
            ExportAction::make()
                ->label(__('Export authors'))
                ->exporter(AuthorExporter::class),
            CreateAction::make(),
        ];
    }
}
