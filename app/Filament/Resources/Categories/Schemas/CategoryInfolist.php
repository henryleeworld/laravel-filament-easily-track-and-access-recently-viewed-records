<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label(__('Name')),
                TextEntry::make('slug')
                    ->label(__('Slug')),
                TextEntry::make('description')
                    ->label(__('Description')),
                IconEntry::make('is_visible')
                    ->label(__('Visibility')),
                TextEntry::make('updated_at')
                    ->label(__('Last updated'))
                    ->dateTime(),
            ])
            ->columns(1)
            ->inlineLabel();
    }
}
