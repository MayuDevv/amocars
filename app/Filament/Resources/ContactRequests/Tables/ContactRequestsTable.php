<?php

namespace App\Filament\Resources\ContactRequests\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ContactRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Cliente')
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('Telefono'),

                TextColumn::make('car.model')
                    ->label('Auto'),

                TextColumn::make('status')
                    ->label('Stato')
                    ->badge(),

                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime(),
            ]);
    }
}