<?php

namespace App\Filament\Resources\Authors\Schemas;

use App\Models\Author;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AuthorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label(__('Email'))
                    ->maxLength(255)
                    ->email()
                    ->unique(Author::class, 'email', ignoreRecord: true)
                    ->required(),
                Textarea::make('bio')
                    ->label(__('Bio'))
                    ->maxLength(1024)
                    ->columnSpanFull(),
                TextInput::make('github_handle')
                    ->label(__('GitHub handle'))
                    ->maxLength(255),
                TextInput::make('twitter_handle')
                    ->label(__('Twitter handle'))
                    ->maxLength(255),
            ]);
    }
}
