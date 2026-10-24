<?php

namespace App\Filament\Resources\Rentals\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class RentalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('car.model')
                    ->label('Auto')
                    ->searchable(),

                TextColumn::make('daily_price')
                    ->label('Prezzo/giorno')
                    ->money('EUR'),

                IconColumn::make('available')
                    ->label('Disponibile')
                    ->boolean(),
            ]);
    }
}