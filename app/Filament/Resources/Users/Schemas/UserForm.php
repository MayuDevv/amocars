<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;


class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->revealable()
                    ->minLength(8)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),

                Select::make('role')
                    ->label('Ruolo')
                    ->options([
                        'admin' => 'Amministratore',
                        'user' => 'Utente',
                    ])
                    ->default('user')
                    ->required(),

                Toggle::make('is_active')
                    ->label('Utente attivo')
                    ->default(true),

                Toggle::make('email_verified_at')
                    ->label('Email verificata')
                    ->default(false)
                    ->dehydrateStateUsing(
                        fn ($state) => $state ? now() : null
                    ),
            ]);
    }
}