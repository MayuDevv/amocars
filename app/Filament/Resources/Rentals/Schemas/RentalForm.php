<?php

namespace App\Filament\Resources\Rentals\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RentalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('car_id')
                    ->label('Auto')
                    ->relationship('car', 'model')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('daily_price')
                    ->label('Prezzo giornaliero')
                    ->numeric()
                    ->prefix('€')
                    ->required(),

                Toggle::make('available')
                    ->label('Disponibile')
                    ->default(true),
            ]);
    }
}