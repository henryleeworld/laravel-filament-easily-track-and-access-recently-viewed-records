<?php

namespace App\Filament\Imports;

use App\Models\Category;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class CategoryImporter extends Importer
{
    protected static ?string $model = Category::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->label(__('Name'))
                ->requiredMapping()
                ->rules(['required', 'max:255'])
                ->example('Category A'),
            ImportColumn::make('slug')
                ->label(__('Slug'))
                ->requiredMapping()
                ->rules(['required', 'max:255'])
                ->example('category-a'),
            ImportColumn::make('description')
                ->label(__('Description'))
                ->example('This is the description for Category A.'),
            ImportColumn::make('is_visible')
                ->label(__('Visibility'))
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean'])
                ->example('yes'),
        ];
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your category import has been completed and ' . number_format($import->successful_rows) . ' ' . __(str('row')->plural($import->successful_rows)) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . __(str('row')->plural($failedRowsCount)) . __(' failed to import.');
        }

        return $body;
    }

    /**
     * @return class-string<Model>
     */
    public static function getModel(): string
    {
        return __('categories');
    }

    public function resolveRecord(): ?Category
    {
        return Category::firstOrNew([
            'slug' => $this->data['slug'],
        ]);
    }
}
