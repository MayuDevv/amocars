<?php

namespace App\Filament\Resources\ContactRequests\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ContactRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('car_id')
                    ->label('Auto interessata')
                    ->relationship('car', 'model')
                    ->searchable()
                    ->preload(),

                TextInput::make('name')
                    ->label('Nome')
                    ->required(),

                TextInput::make('phone')
                    ->label('Telefono')
                    ->tel(),

                Textarea::make('message')
                    ->label('Messaggio')
                    ->columnSpanFull(),

                Select::make('status')
                    ->label('Stato')
                    ->options([
                        'new' => 'Nuova',
                        'contacted' => 'Contattato',
                        'closed' => 'Chiusa',
                    ])
                    ->default('new'),
            ]);
    }
}