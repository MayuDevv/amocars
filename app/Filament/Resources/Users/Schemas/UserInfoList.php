<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nome'),

                TextEntry::make('email')
                    ->label('Email'),

                TextEntry::make('role')
                    ->label('Ruolo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'admin' => 'Amministratore',
                        'user' => 'Utente',
                        default => $state,
                    }),

                IconEntry::make('is_active')
                    ->label('Stato')
                    ->boolean(),

                IconEntry::make('email_verified_at')
                    ->label('Email verificata')
                    ->boolean()
                    ->getStateUsing(
                        fn ($record): bool => filled($record->email_verified_at)
                    ),

                TextEntry::make('created_at')
                    ->label('Registrato il')
                    ->dateTime('d/m/Y H:i'),

                TextEntry::make('updated_at')
                    ->label('Ultima modifica')
                    ->dateTime('d/m/Y H:i'),
            ]);
    }
}