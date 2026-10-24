<?php

namespace App\Filament\Resources\Cars\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;

class CarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('brand')
                    ->label('Marca')
                    ->required(),
                TextInput::make('model')
                    ->label('Modello')
                    ->required(),
                TextInput::make('plate')
                    ->label('Targa'),
                TextInput::make('version')
                    ->label('Versione'),
                TextInput::make('year')
                    ->label('Anno'),
                TextInput::make('km')
                    ->label('Chilometri')
                    ->numeric(),
                Select::make('fuel')
                    ->label('Carburante')
                    ->options(['benzina' => 'Benzina', 'diesel' => 'Diesel', 'elettrica' => 'Elettrica', 'ibrida' => 'Ibrida']),
                TextInput::make('engine')
                    ->label('Cilindrata'),
                TextInput::make('price')
                    ->label('Prezzo')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
                Textarea::make('description')
                    ->label('Descrizione')
                    ->columnSpanFull(),
                Select::make('status')
                    ->label('Stato')
                    ->options(['disponibile' => 'Disponibile', 'venduta' => 'Venduta', 'riservata' => 'Riservata'])
                    ->default('disponibile'),
                Toggle::make('featured')
                    ->label('In evidenza'),
                FileUpload::make('images')
                    ->label('Foto auto')
                    ->multiple()
                    ->image()
                    ->directory('cars')
                    ->disk('public')
                    ->reorderable()
                    ->appendFiles()
                    ->maxFiles(20)
                    ->imagePreviewHeight('150'),
            ]);
    }
}
