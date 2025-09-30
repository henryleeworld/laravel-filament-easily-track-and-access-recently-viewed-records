<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Post;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->label(__('Title'))
                            ->live(onBlur: true)
                            ->maxLength(255)
                            ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state, language: app()->getLocale())) : null)
                            ->required(),
                        TextInput::make('slug')
                            ->label(__('Slug'))
                            ->disabled()
                            ->dehydrated()
                            ->maxLength(255)
                            ->unique(Post::class, 'slug', ignoreRecord: true)
                            ->required(),
                        MarkdownEditor::make('content')
                            ->label(__('Content'))
                            ->columnSpan('full')
                            ->required(),
                        Select::make('author_id')
                            ->label(__('Author'))
                            ->relationship('author', 'name')
                            ->searchable()
                            ->required(),
                        Select::make('category_id')
                            ->label(__('Category'))
                            ->relationship('category', 'name')
                            ->searchable()
                            ->required(),
                        DatePicker::make('published_at')
                            ->label(__('Published Date')),

                    ])
                    ->columns(2),
                Section::make(__('Image'))
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),
            ]);
    }
}
