<?php

namespace App\Filament\Resources\Authors\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AuthorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    Stack::make([
                        TextColumn::make('name')
                            ->label(__('Name'))
                            ->searchable()
                            ->sortable()
                            ->weight('medium')
                            ->alignLeft(),
                        TextColumn::make('email')
                            ->label(__('Email'))
                            ->searchable()
                            ->sortable()
                            ->color('gray')
                            ->alignLeft(),
                    ])->space(),
                    Stack::make([
                        TextColumn::make('github_handle')
                            ->label(__('GitHub handle'))
                            ->alignLeft(),
                        TextColumn::make('twitter_handle')
                            ->label(__('Twitter handle'))
                            ->alignLeft(),
                    ])->space(2),
                ])->from('md'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->groupedBulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
