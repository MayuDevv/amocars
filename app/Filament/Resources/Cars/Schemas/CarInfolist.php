<?php

namespace App\Filament\Resources\Cars\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CarInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('brand')
                    ->label('Marca'),
                TextEntry::make('model')
                    ->label('Modello'),
                TextEntry::make('plate')
                    ->label('Targa')
                    ->placeholder('-'),
                TextEntry::make('version')
                    ->label('Versione')
                    ->placeholder('-'),
                TextEntry::make('year')
                    ->label('Anno')
                    ->placeholder('-'),
                TextEntry::make('km')
                    ->label('Chilometri')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('fuel')
                    ->label('Carburante')
                    ->placeholder('-'),
                TextEntry::make('engine')
                    ->label('Cilindrata')
                    ->placeholder('-'),
                TextEntry::make('price')
                    ->label('Prezzo')
                    ->money(),
                TextEntry::make('description')
                    ->label('Descrizione')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('status')
                    ->label('Stato')
                    ->badge()
                    ->placeholder('-'),
                IconEntry::make('featured')
                    ->label('In evidenza')
                    ->boolean()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->label('Creato')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Aggiornato')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
