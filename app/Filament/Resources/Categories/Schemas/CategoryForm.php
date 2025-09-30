<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state, language: app()->getLocale())) : null)
                    ->required(),
                TextInput::make('slug')
                    ->label(__('Slug'))
                    ->disabled()
                    ->dehydrated()
                    ->maxLength(255)
                    ->unique(Category::class, 'slug', ignoreRecord: true)
                    ->required(),
                RichEditor::make('description')
                    ->label(__('Description'))
                    ->columnSpan('full'),
                Toggle::make('is_visible')
                    ->label(__('Visibility'))
                    ->default(true),
            ]);
    }
}
