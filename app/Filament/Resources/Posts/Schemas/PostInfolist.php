<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Flex::make([
                            Grid::make(2)
                                ->schema([
                                    Group::make([
                                        TextEntry::make('title')
                                            ->label(__('Title')),
                                        TextEntry::make('slug')
                                            ->label(__('Slug')),
                                        TextEntry::make('published_at')
                                            ->label(__('Published Date'))
                                            ->badge()
                                            ->date()
                                            ->color('success'),
                                    ]),
                                    Group::make([
                                        TextEntry::make('author.name')
                                            ->label(__('Author')),
                                        TextEntry::make('category.name')
                                            ->label(__('Category')),
                                    ]),
                                ]),
                            ImageEntry::make('image')
                                ->disk('public')
                                ->hiddenLabel()
                                ->grow(false),
                        ])->from('lg'),
                    ]),
                Section::make(__('Content'))
                    ->schema([
                        TextEntry::make('content')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),
            ]);
    }
}
