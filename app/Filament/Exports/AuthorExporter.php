<?php

namespace App\Filament\Exports;

use App\Models\Author;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class AuthorExporter extends Exporter
{
    protected static ?string $model = Author::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label(__('ID')),
            ExportColumn::make('name')
                ->label(__('Name')),
            ExportColumn::make('email')
                ->label(__('Email')),
            ExportColumn::make('github_handle')
                ->label(__('GitHub handle')),
            ExportColumn::make('twitter_handle')
                ->label(__('Twitter handle')),
            ExportColumn::make('created_at')
                ->label(__('Time created')),
            ExportColumn::make('updated_at')
                ->label(__('Last updated')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = __('Your author export has been completed and ') . number_format($export->successful_rows) . ' ' . __(str('row')->plural($export->successful_rows)) . __(' exported.');

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . __(str('row')->plural($failedRowsCount)) . __(' failed to export.');
        }

        return $body;
    }

    public static function getModel(): string
    {
        return __('authors');
    }
}
