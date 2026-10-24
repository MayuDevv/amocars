<?php

namespace App\Filament\Resources\Cars\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('brand')
                    ->searchable()
                    ->label('Marca'),
                TextColumn::make('model')
                    ->searchable()
                    ->label('Modello'),
                TextColumn::make('plate')
                    ->searchable()
                    ->label('Targa'),
                TextColumn::make('version')
                    ->searchable()
                    ->label('Versione'),
                TextColumn::make('year')
                    ->label('Anno'),
                TextColumn::make('km')
                    ->numeric()
                    ->label('Chilometri')
                    ->sortable(),
                TextColumn::make('fuel')
                    ->searchable()
                    ->label('Carburante'),
                TextColumn::make('engine')
                    ->searchable()
                    ->label('Cilindrata'),
                TextColumn::make('price')
                    ->money('EUR')
                    ->label('Prezzo')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Stato')
                    ->badge(),
                IconColumn::make('featured')
                    ->label('In evidenza')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Creato')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Aggiornato')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
