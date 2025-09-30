<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Post;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label(__('Image'))
                    ->disk('public')
                    ->extraImgAttributes([
                        'loading' => 'lazy',
                    ]),
                TextColumn::make('title')
                    ->label(__('Title'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label(__('Slug'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('author.name')
                    ->label(__('Author'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->getStateUsing(fn (Post $record): string => $record->published_at?->isPast() ? __('Published') : __('Draft'))
                    ->colors([
                        'success' => __('Published'),
                    ]),
                TextColumn::make('category.name')
                    ->label(__('Category'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('published_at')
                    ->label(__('Published Date'))
                    ->date(),
            ])
            ->filters([
                Filter::make('published_at')
                    ->schema([
                        DatePicker::make('published_from')
                            ->label(__('Published from'))
                            ->placeholder(fn ($state): string => now()->subYear()->format('M d, Y')),
                        DatePicker::make('published_until')
                            ->label(__('Published until'))
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['published_from'] ?? null) {
                            $publishedFrom = Carbon::parse($data['published_from']);
                            $publishedFrom->locale(config('app.locale'));
                            $publishedFrom->settings(['formatFunction' => 'translatedFormat']);
                            $indicators['published_from'] = __('Published from :published_from', ['published_from' => $publishedFrom->format('F j S Y')]);
                        }
                        if ($data['published_until'] ?? null) {
                            $publishedUntil = Carbon::parse($data['published_until']);
                            $publishedUntil->locale(config('app.locale'));
                            $publishedUntil->settings(['formatFunction' => 'translatedFormat']);
                            $indicators['published_until'] = __('Published until :published_until', ['published_until' => $publishedUntil->format('F j S Y')]);
                        }
                        return $indicators;
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->groupedBulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
